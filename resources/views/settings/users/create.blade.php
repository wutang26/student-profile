@extends('layouts.admin')

@section('content')

<h1 class="page-title">Dashboard</h1>

<!-- BACK -->
<div class="back-link">
    <a href="{{ route('settings.users.index') }}">&larr; Back</a>
</div>

<!-- CARD -->
<div class="form-card">

    <h2 class="form-title">Register New Member</h2>

    <form method="POST" action="{{ route('settings.users.storeUser') }}" class="form">
        @csrf

        <h3 class="section-title">Basic Information</h3>

        <!-- ROW 1 -->
        <div class="form-grid">

            <div class="form-group">
                <label>User Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Date Joined</label>
                <input type="date" name="date_joined" max="{{ date('Y-m-d') }}" required>
            </div>

        </div>

        <!-- ROW 2 -->
        <div class="form-grid">

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="">Select Status</option>
                    <option value="active">Active</option>
                    <option value="pending">Pending</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

        </div>

        <!-- ROW 3 -->
        <div class="form-grid">

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" minlength="8" required placeholder="Enter password">
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" minlength="8" required placeholder="Confirm password">
            </div>

        </div>

        <!-- ROLE -->
        <div class="form-grid">

            <div class="form-group">
                <label>Role</label>
                <select name="role" required>
                    <option value="">Select Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <!-- BUTTON -->
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                Save User
            </button>
        </div>

    </form>

</div>

@endsection