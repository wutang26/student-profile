@extends('layouts.admin')

@section('content')

@if ($errors->any())
    <div class="alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h1 class="page-title">Dashboard</h1>

<!-- BACK -->
<div class="back-link">
    <a href="{{ route('settings.users.index') }}">&larr; Back</a>
</div>

<!-- CARD -->
<div class="form-card">

    <h2 class="form-title">Edit User</h2>

    <form method="POST" action="{{ route('settings.users.updateUser', $user->id) }}" class="form">
        @csrf
        @method('PUT')

        <h3 class="section-title">Basic Information</h3>

        <div class="form-grid">

            <!-- Name -->
            <div class="form-group">
                <label>User Name</label>
                <input type="text" name="name"
                       value="{{ old('name', $user->name) }}"
                       required>
            </div>

            <!-- User Type -->
            <div class="form-group">
                <label>User Type (Role)</label>
                <input type="text" name="usertype"
                       value="{{ old('usertype', $user->usertype) }}"
                       required>
            </div>

        </div>

        <!-- EMAIL + STATUS -->
        <div class="form-grid">

            <!-- Email -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                       value="{{ old('email', $user->email) }}"
                       required>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

        </div>

        <!-- PASSWORD -->
        <div class="form-grid">

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Leave blank to keep current password">
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Leave blank to keep current password">
            </div>

        </div>

        <!-- BUTTON -->
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                Update User
            </button>
        </div>

    </form>

</div>

@endsection