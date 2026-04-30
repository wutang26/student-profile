@extends('layouts.admin')

@section('content')

@php $i = 0; @endphp

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif


<h1 class="page-title">Roles Summary</h1>

<!-- CARDS -->
<div class="card-grid">

    <div class="card">
        <h2>Total Roles</h2>
        <p></p>
    </div>

    <div class="card">
        <h2>Active Roles</h2>
        <p></p>
    </div>

    <div class="card">
        <h2>Total Roles</h2>
        <p></p>
    </div>

</div>

<br>

<!-- TABLE SECTION -->
<div class="table-wrapper">

    @auth
    @role('super-admin|admin')
    <a href="{{ route('settings.roles.create') }}" class="btn-create">
        Register Role
    </a>
    @endrole
    @endauth

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Role Name</th>
                <th>Description</th>
                <th>Permissions</th>
                <th>Created Date</th>
                <th>Status</th>
                @auth
                @role('super-admin|admin')
                <th>Actions</th>
                @endrole
                @endauth
            </tr>
        </thead>

        <tbody>
        @foreach ($roles as $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>

                <!-- Permissions -->
                <td>
                    @if ($role->permissions->count())
                        <div class="badge-wrap">
                            @foreach ($role->permissions as $permission)
                                <span class="badge">
                                    {{ $permission->label ?? $permission->name }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <span class="text-muted">No permissions</span>
                    @endif
                </td>

                <td>{{ $role->created_at->format('d M Y, h:i A') }}</td>

                <td>
                    <span class="status {{ $role->status }}">
                        {{ ucfirst($role->status) }}
                    </span>
                </td>

                @auth
                @role('super-admin|admin')
                <td>
                    <a href="{{ route('settings.roles.edit', $role->id) }}" class="btn-edit">
                        Edit
                    </a>

                    <form action="{{ route('settings.roles.deleteRole', $role->id) }}"
                          method="POST"
                          class="inline-form"
                          onsubmit="return confirm('Delete this role?');">
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

@endsection