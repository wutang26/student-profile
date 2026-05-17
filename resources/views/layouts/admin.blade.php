<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!--- Offline Bootstrap --->

    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</head>

<body>

<button class="mobile-toggle" id="mobileToggle">
    ☰
</button>

<div class="layout">

    <!-- SIDEBAR -->
 <aside class="sidebar">
    <div class="sidebar-title">
        Company Mng Portal   <!--Company Resource Management Systerm-->
    </div>

    <nav class="menu">

        <!-- DASHBOARD -->
        <a href="{{ route('dashboard') }}" class="menu-item">
           <span class="menu-icon">📊</span>Dashboard
        </a>

        <!-- ================= STUDENTS ================= -->
        <div class="menu-group">
            <button class="menu-toggle">
                <span><span class="menu-icon">🎓</span>Students</span>
                <span class="dropdown-arrow">▼</span>
            </button>

            <div class="menu-content">
            <a href="{{ route('students.index') }}" class="menu-item small">
              <span class="menu-icon">✍️</span> All Students
            </a>

            <a href="{{ route('students.documents.index') }}" class="menu-item small">
                <span class="menu-icon">📎</span>Attachments
            </a>
            </div>
        </div>

        <!-- ================= STAFF ================= -->
        <div class="menu-group">
            <button class="menu-toggle">
                <span><span class="menu-icon">👮</span> Staff</span>
                <span class="dropdown-arrow">▼</span>
            </button>

        <div class="menu-content">
              <a href="{{ route('staff.index') }}" class="menu-item small">
                <span class="menu-icon">👔</span> All Staff
            </a>
             <a href="#" class="menu-item small">
               <span class="menu-icon">🏛️</span> Organization Structure
            </a>
         </div>
        </div>

        <!-- ================= STORE ================= -->
        <div class="menu-group">
            <button class="menu-toggle">
                <span><span class="menu-icon">📦</span>Store Management</span>
                <span class="dropdown-arrow">▼</span>
            </button>

            <div class="menu-content">
              <a href="{{ route('storeItems.index') }}" class="menu-item small">
            <span class="menu-icon">🗃️</span> Registered Items
           </a>

            <a href="{{ route('borrowItems.index') }}" class="menu-item small">
            <span class="menu-icon">🔄</span> Borrow Items
            </a>

            <a href="{{ route('borrowItems.returned') }}" class="menu-item small">
                <span class="menu-icon">✅</span>Returned Items
            </a>
            </div>
        </div>

        <!-- ================= REPORTS ================= -->
        <div class="menu-group">
            <button class="menu-toggle">
                <span><span class="menu-icon">📑</span>Reports</span>
                <span class="dropdown-arrow">▼</span>
            </button>

            <div class="menu-content">
                <a href="{{ route('pdf.dismissedPreview') }}" class="menu-item small">
                        <span class="menu-icon">🚫</span> Dismissed Students
                    </a>

                    <a href="{{ route('pdf.returnedPreview') }}" class="menu-item small">
                        <span class="menu-icon">✅</span>Returned Items
                    </a>

                    <a href="{{ route('pdf.notReturned') }}" class="menu-item small">
                      <span class="menu-icon">⚠️</span> Un Returned Items
                    </a>
            </div>
        </div>

        <!-- ================= SETTINGS ================= -->
        @can('manage users')
        <div class="menu-group">
            <button class="menu-toggle">
                <span><span class="menu-icon">⚙️</span>Settings</span>
                <span class="dropdown-arrow">▼</span>
            </button>

            <div class="menu-content">
               <a href="{{ route('admin.audit.index') }}" class="menu-item small">
                     <span class="menu-icon">📡</span> Audits
                    </a>

                    <a href="{{ route('courses.index') }}" class="menu-item small">
                       <span class="menu-icon">📖</span> Courses
                    </a>

                    <a href="{{ route('settings.users.index') }}" class="menu-item small">
                       <span class="menu-icon">👥</span>Users
                    </a>

                    <a href="{{ route('settings.roles.index') }}" class="menu-item small">
                        <span class="menu-icon">🛡️</span>Roles
                    </a>

                    <a href="{{ route('settings.permissions.index') }}" class="menu-item small">
                       <span class="menu-icon">🔑</span>Permissions
                    </a>

                    <a href="{{ route('settings.regions.region') }}" class="menu-item small">
                        <span class="menu-icon">📍</span>Regions
                    </a>

                    <a href="{{ route('settings.district') }}" class="menu-item small">
                        <span class="menu-icon">🏢</span>Districts
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
                &nbsp;&nbsp;&nbsp;  Welcome, <strong>{{ auth()->user()->name }}</strong>
            </div>

            <div class="user-menu">
                <button id="user-menu-button" class="user-btn">
                  <img src="{{ Auth::user()->profile_photo ? asset(Auth::user()->profile_photo) : asset('images/default-avatar.png') }}" class="avatar">
                    <span>{{ Auth::user()->name }}</span>
                    <span class="dropdown-arrow">▼</span>
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

// MOBILE SIDEBAR
const mobileToggle = document.getElementById('mobileToggle');
const sidebar = document.querySelector('.sidebar');

mobileToggle.addEventListener('click', function () {
    sidebar.classList.toggle('show');
});
</script>

<script>
console.log("Bootstrap Loaded:", typeof bootstrap !== 'undefined');
</script>


</body>
</html>