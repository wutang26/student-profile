@extends('layouts.admin')

@section('content')

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<h1 class="page-title">Users Dashboard</h1>

<!-- SUMMARY CARDS -->
<div class="card-grid">

    <div class="card">
        <h2>Available Users</h2>
        <p>{{ $users->count() }}</p>
    </div>

    <div class="card">
        <h2>Active Users</h2>
        <p>{{ $users->count() }}</p>
    </div>

    <div class="card">
        <h2>Total Users</h2>
        <p>{{ $users->count() }}</p>
    </div>

</div>

<br>

<!-- USERS TABLE -->
<div class="table-wrapper">

    @auth
    @role('super-admin|admin')
    <a href="{{ route('settings.users.create') }}" class="btn-create">
        Register User
    </a>
    @endrole
    @endauth

    @php $i = 0; @endphp

    <table class="table">

        <thead>
            <tr>
                <th>Id</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Permissions</th>
                <th>Assign Permissions</th>
                <th>Date Joined</th>
                <th>Status</th>
                @auth
                @role('super-admin|admin')
                <th>Actions</th>
                @endrole
                @endauth
            </tr>
        </thead>

        <tbody>

        @foreach ($users as $user)
        <tr>

            <td>{{ ++$i }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>

            <!-- Roles -->
            <td>
                @foreach($user->roles as $role)
                    <span class="badge-role">{{ $role->name }}</span>
                @endforeach
            </td>

            <!-- Permissions -->
            <td class="small-text">
                {{ $user->getAllPermissions()->pluck('name')->join(', ') ?: 'None' }}
            </td>

            <!-- Assign -->
            <td>
                <form method="POST" action="{{ route('users.assign_permissions', $user->id) }}">
                    @csrf
                    <button type="submit" class="btn-small">
                        Assign Permissions
                    </button>
                </form>
            </td>

            <td>{{ $user->created_at->format('d M Y') }}</td>

            <!-- STATUS -->
            <td>
                <span class="status {{ $user->status }}">
                    {{ ucfirst($user->status) }}
                </span>
            </td>

            <!-- ACTIONS -->
            @auth
            @role('super-admin|admin')
            <td class="action-col">

                <a href="{{ route('settings.users.editUser', $user->id) }}" class="btn-edit">
                    Edit
                </a>

                <form action="{{ route('settings.users.deleteUser', $user->id) }}"
                      method="POST"
                      onsubmit="return confirm('Delete this user?');"
                      class="inline-form">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-delete">
                        Delete
                    </button>
                </form>

            </td>
            @endrole
            @endauth

        </tr>
        @endforeach

        </tbody>
    </table>

</div>

<style>
        /* =========================
   ACTION COLUMN LAYOUT
========================= */
.action-col{
    display: flex;
    align-items: center;
    gap: 10px;
    white-space: nowrap;
}

/* =========================
   EDIT BUTTON (CLEAN BLUE)
========================= */
.btn-edit{
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    border-radius: 8px;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.2s ease;
    box-shadow: 0 2px 6px rgba(29, 78, 216, 0.2);
}

.btn-edit:hover{
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(29, 78, 216, 0.3);
}

/* =========================
   DELETE BUTTON (DANGER RED)
========================= */
.btn-delete{
    display: inline-flex;
    align-items: center;
    padding: 6px 12px;
    border-radius: 8px;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    font-size: 13px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: 0.2s ease;
}

.btn-delete:hover{
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

/* =========================
   INLINE FORM FIX
========================= */
.inline-form{
    display: inline;
}
</style>

@endsection