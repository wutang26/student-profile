<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

        <!-- ================= STUDENTS ================= -->
        <div class="menu-group">
            <button class="menu-toggle">
                <span><i class="bi bi-people"></i> Students</span>
                <i class="bi bi-chevron-down icon"></i>
            </button>

            <div class="menu-content">
                <a href="{{ route('students.index') }}" class="menu-item small">
                    All Students
                </a>
                <a href="{{ route('students.documents.index') }}" class="menu-item small">
                    Attachments
                </a>
            </div>
        </div>

        <!-- ================= STAFF ================= -->
        <div class="menu-group">
            <button class="menu-toggle">
                <span><i class="bi bi-person-badge"></i> Staff</span>
                <i class="bi bi-chevron-down icon"></i>
            </button>

            <div class="menu-content">
                <a href="{{ route('staff.index') }}" class="menu-item small">
                    All Staff
                </a>
            </div>
        </div>

        <!-- ================= STORE ================= -->
        <div class="menu-group">
            <button class="menu-toggle">
                <span><i class="bi bi-boxes"></i> Store Management</span>
                <i class="bi bi-chevron-down icon"></i>
            </button>

            <div class="menu-content">
                <a href="{{ route('storeItems.index') }}" class="menu-item small">
                    Registered Items
                </a>

                <a href="{{ route('borrowItems.index') }}" class="menu-item small">
                    Borrow Items
                </a>

                <a href="{{ route('borrowItems.returned') }}" class="menu-item small">
                    Returned Items
                </a>
            </div>
        </div>

        <!-- ================= REPORTS ================= -->
        <div class="menu-group">
            <button class="menu-toggle">
                <span><i class="bi bi-bar-chart"></i> Reports</span>
                <i class="bi bi-chevron-down icon"></i>
            </button>

            <div class="menu-content">
                <a href="{{ route('pdf.dismissedPreview') }}" class="menu-item small">Dismissed Students</a>
                <a href="{{route('pdf.returnedPreview')}}" class="menu-item small">Returned Items</a>
                <a href="{{route('pdf.notReturned')}}" class="menu-item small">Un Returned Items</a>
            </div>
        </div>

        <!-- ================= SETTINGS ================= -->
        @can('manage users')
        <div class="menu-group">
            <button class="menu-toggle">
                <span><i class="bi bi-gear"></i> Settings</span>
                <i class="bi bi-chevron-down icon"></i>
            </button>

            <div class="menu-content">
                <a href="{{ route('admin.audit.index') }}" class="menu-item small">Audits</a>
                <a href="{{ route('courses.index') }}" class="menu-item small">Courses</a>
                <a href="{{ route('settings.users.index') }}" class="menu-item small">Users</a>
                <a href="{{ route('settings.roles.index') }}" class="menu-item small">Roles</a>
                <a href="{{ route('settings.permissions.index') }}" class="menu-item small">Permissions</a>
                <a href="{{ route('settings.regions.region') }}" class="menu-item small">Regions</a>
                <a href="{{ route('settings.district') }}" class="menu-item small">Districts</a>
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
                &nbsp;&nbsp;&nbsp;  Welcome, <strong>{{ auth()->user()->name }}</strong>
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
document.addEventListener('DOMContentLoaded', function () {

    const groups = document.querySelectorAll('.menu-group');

    groups.forEach(group => {
        const btn = group.querySelector('.menu-toggle');

        btn.addEventListener('click', function (e) {
            e.stopPropagation();

            // close others
            groups.forEach(g => {
                if (g !== group) g.classList.remove('open');
            });

            // toggle current
            group.classList.toggle('open');
        });
    });

    // close when clicking outside
    document.addEventListener('click', function () {
        groups.forEach(g => g.classList.remove('open'));
    });

    // USER DROPDOWN
    const userBtn = document.getElementById('user-menu-button');
    const userDropdown = document.getElementById('user-menu-dropdown');

    userBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        userDropdown.classList.toggle('show');
    });

});
</script>

</body>
</html>