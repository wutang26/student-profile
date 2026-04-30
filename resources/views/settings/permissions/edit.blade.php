@extends('layouts.admin')

@section('content')

<h1 class="page-title">Edit Permission</h1>

<!-- BACK -->
<div class="back-link">
    <a href="{{ route('settings.permissions.index') }}">&larr; Back</a>
</div>

<!-- CARD -->
<div class="form-card">

    <h2 class="form-title">Edit Permission</h2>

    <form method="POST" action="{{ route('settings.permissions.updatePermission', $permission->id) }}" class="form">
        @csrf
        @method('PUT')

        <h3 class="section-title">Basic Information</h3>

        <div class="form-grid">

            <!-- MODULE -->
            <div class="form-group">
                <label>Module Name</label>
                <select name="module" required>
                    <option value="">-- Select Module --</option>

                    <option value="loan_officer"
                        {{ old('module', $permission->module) == 'loan_officer' ? 'selected' : '' }}>
                        Loan Officer
                    </option>

                    <option value="accountant"
                        {{ old('module', $permission->module) == 'accountant' ? 'selected' : '' }}>
                        Accountant
                    </option>

                    <option value="users"
                        {{ old('module', $permission->module) == 'users' ? 'selected' : '' }}>
                        Users
                    </option>

                    <option value="roles"
                        {{ old('module', $permission->module) == 'roles' ? 'selected' : '' }}>
                        Roles
                    </option>

                </select>
            </div>

            <!-- LABEL -->
            <div class="form-group">
                <label>Permission Label</label>
                <input type="text"
                       name="lable"
                       value="{{ old('lable', $permission->lable) }}"
                       required>
            </div>

            <!-- DESCRIPTION -->
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4">{{ old('description', $permission->description) }}</textarea>
            </div>

        </div>

        <!-- STATUS -->
        <h3 class="section-title">Status</h3>

        <div class="form-grid">

            <div class="form-group">
                <label>Status</label>
                <select name="is_active" required>
                    <option value="1" {{ old('is_active', $permission->is_active) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', $permission->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

        </div>

        <!-- BUTTON -->
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                Update Permission
            </button>
        </div>

    </form>

</div>

@endsection