@extends('layouts.admin')

@section('content')

<h1 class="page-title">Dashboard</h1>

<!-- BACK -->
<div class="back-link">
    <a href="{{ route('settings.permissions.index') }}">&larr; Back</a>
</div>

<!-- CARD -->
<div class="form-card">

    <!-- ERRORS -->
    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2 class="form-title">Register Permission</h2>

    <form method="POST" action="{{ route('settings.permissions.storePermission') }}" class="form">
        @csrf

        <h3 class="section-title">Basic Information</h3>

        <div class="form-grid">

            <!-- MODULE -->
            <div class="form-group">
                <label>Module Name</label>
                <select name="module" required>
                    <option value="">-- Select Permission Group --</option>
                    <option value="loan_officer">Loan Officer</option>
                    <option value="accountant">Accountant</option>
                    <option value="users">Users</option>
                    <option value="roles">Roles</option>
                </select>
            </div>

            <!-- LABEL -->
            <div class="form-group">
                <label>Permission Label</label>
                <input type="text"
                       name="permissions"
                       placeholder="Approve loans, View loans, Delete loans"
                       required>
            </div>

            <!-- DESCRIPTION -->
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4"></textarea>
            </div>

            <!-- STATUS -->
            <div class="form-group">
                <label>Status</label>
                <select name="is_active" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

        </div>

        <!-- BUTTON -->
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                Save Permission
            </button>
        </div>

    </form>

</div>

@endsection