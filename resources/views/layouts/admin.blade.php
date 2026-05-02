<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-title">
            Admin Panel
        </div>
        
<nav class="menu">

    <!-- DASHBOARD -->
    <a href="{{ route('dashboard') }}" class="menu-item">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    {{-- ================= STUDENTS ================= --}}
    <div class="dropdown">
        <button class="dropdown-toggle">
            <span><i class="bi bi-people"></i> Students</span>
            <i class="bi bi-chevron-down"></i>
        </button>

        <div class="dropdown-menu hidden">

            <a href="{{ route('students.index') }}" class="menu-item small">
                <i class="bi bi-list"></i> All Students
            </a>

            <a href="{{ route('students.documents.index') }}" class="menu-item small">
                <i class="bi bi-folder"></i> Attachments
            </a>

        </div>
    </div>

    
 <div class="dropdown">
        <button class="dropdown-toggle">
            <span><i class="bi bi-people"></i> Staff</span>
            <i class="bi bi-chevron-down"></i>
        </button>

        <div class="dropdown-menu hidden">

            <a href="{{ route('staff.index') }}" class="menu-item small">
                <i class="bi bi-list"></i> All Staff
            </a>

            <!-- @can('view student documents')
            <a href="#" class="menu-item small">
                <i class="bi bi-folder"></i> All staff
            </a>
            @endcan -->

        </div>
    </div>

 

    {{-- ================= AUDITS (REMOVE FAKE PERMISSION) ================= --}}
 
    <a href="{{ route('admin.audit.index') }}" class="menu-item">
        <i class="bi bi-journal-text"></i> Audits
    </a>

        {{-- ================= Items Store Management ================= --}}
       @can('view students')
    <div class="dropdown">
        <button class="dropdown-toggle">
            <span><i class="bi bi-boxes"></i>   Store Management</span>
            <i class="bi bi-chevron-down"></i>
        </button>

        <div class="dropdown-menu hidden">
            <a href="#" class="menu-item small">
                <i class="bi bi-archive"></i> Registered Items
            </a>
        </div>
    </div>
    @endcan


    {{-- ================= REPORTS (FIXED) ================= --}}
    @can('view students')
    <div class="dropdown">
        <button class="dropdown-toggle">
            <span><i class="bi bi-bar-chart"></i> Reports</span>
            <i class="bi bi-chevron-down"></i>
        </button>

        <div class="dropdown-menu hidden">
            <a href="{{ route('pdf.preview') }}" class="menu-item small">
                <i class="bi bi-file-earmark-pdf"></i> Student Report
            </a>
             <a href="#" class="menu-item small">
                <i class="bi bi-file-earmark-pdf"></i> Borrowed Items
            </a>
        </div>
    </div>
    @endcan


    {{-- ================= SETTINGS (ONLY FOR MANAGE USERS/ROLES) ================= --}}
    @can('manage users')
    <div class="dropdown">
        <button class="dropdown-toggle">
            <span><i class="bi bi-gear"></i> Settings</span>
            <i class="bi bi-chevron-down"></i>
        </button>

        <div class="dropdown-menu hidden">

            <a href="{{ route('settings.users.index') }}" class="menu-item small">
                Users
            </a>

            @can('manage roles')
            <a href="{{ route('settings.roles.index') }}" class="menu-item small">
                Roles
            </a>
            @endcan

            <a href="{{ route('settings.permissions.index') }}" class="menu-item small">
                Permissions
            </a>

            <a href="{{ route('settings.regions.region') }}" class="menu-item small">
                Regions
            </a>

            <a href="{{ route('settings.district') }}" class="menu-item small">
                Districts
            </a>

        </div>
    </div>
    @endcan

</nav>
    </aside>

    <!-- MAIN -->
    <div class="main">

        <!-- NAVBAR -->
        <header class="navbar">
            <div>
                Welcome, <strong>{{ auth()->user()->name }}</strong>
            </div>

            <div class="user-menu">
                <button id="user-menu-button" class="user-btn">
                    <img src="{{ Auth::user()->profile_photo_url }}" class="avatar">
                    <span>{{ Auth::user()->name }}</span>
                    <i class="bi bi-chevron-down"></i>
                </button>

                <div id="user-menu-dropdown" class="user-dropdown hidden">
                    <a href="{{ route('profile.edit') }}">Profile</a>
                    <a href="{{ route('password.change') }}">Change Password</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout">Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <!-- CONTENT -->
        <main class="content">
            @yield('content')
        </main>

    </div>

</div>

@include('layouts.footer')

<script>
    document.querySelectorAll('.dropdown-toggle').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.nextElementSibling.classList.toggle('hidden');
        });
    });

    const userBtn = document.getElementById('user-menu-button');
    const dropdown = document.getElementById('user-menu-dropdown');

    userBtn.addEventListener('click', () => {
        dropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!userBtn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>

</body>
</html>