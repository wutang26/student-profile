@extends('layouts.admin')

@section('content')

<h2 class="page-title">Assign Roles to Users</h2>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>

                <td>
                    <form action="{{ route('admin.users.role', $user->id) }}" method="POST">
                        @csrf

                        <select name="role" class="form-control">
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                </td>

                <td>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection