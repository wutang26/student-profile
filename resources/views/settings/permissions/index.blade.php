@extends('layouts.admin')

@section('content')

@php $i = 0; @endphp

<h1 class="page-title">Permissions Summary</h1>

<!-- SUMMARY CARDS -->
<div class="card-grid">

    <div class="card">
        <h2>Total Permissions</h2>
        <p>{{ $permissions->count() }}</p>
    </div>

    <div class="card">
        <h2>Active Permissions</h2>
        <p>{{ $permissions->where('status','active')->count() }}</p>
    </div>

    <div class="card">
        <h2>Pending / Others</h2>
        <p>{{ $permissions->where('status','!=','active')->count() }}</p>
    </div>

</div>

<!-- SUCCESS -->
@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<br>

<!-- TABLE AREA -->
<div class="table-wrapper">

    @auth
    @role('super-admin|admin')
    <a href="{{ route('settings.permissions.create') }}" class="btn-create">
        Register Permission
    </a>
    @endrole
    @endauth

    <table class="table">

        <thead>
            <tr>
                <th>Id</th>
                <th>Permission Name</th>
                <th>Module</th>
                <th>Description</th>
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

        @foreach ($permissions as $permission)
        <tr>

            <td>{{ ++$i }}</td>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->module }}</td>
            <td>{{ $permission->description }}</td>
            <td>{{ $permission->created_at->format('d M Y, h:i A') }}</td>

            <!-- STATUS -->
            <td>
                <span class="status {{ $permission->status }}">
                    {{ ucfirst($permission->status) }}
                </span>
            </td>

            <!-- ACTIONS -->
            @auth
            @role('super-admin|admin')
            <td class="action-col">

                <a href="{{ route('settings.permissions.edit', $permission->id) }}" class="btn-edit">
                    Edit
                </a>

                <form action="{{ route('settings.permissions.deletePermission', $permission->id) }}"
                      method="POST"
                      onsubmit="return confirm('Delete this permission?');"
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

@endsection