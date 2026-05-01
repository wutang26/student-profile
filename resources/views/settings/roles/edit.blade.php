@extends('layouts.admin')

@section('content')

<h1 class="page-title">Edit Permission</h1>

<!-- BACK -->
<div class="back-link">
    <a href="{{ route('settings.roles.index') }}">&larr; Back</a>
</div>

<!-- CARD -->
<div class="form-card">

    <h2 class="form-title">Edit Role</h2>

    <form method="POST" action="{{ route('settings.roles.updateRole', $role->id) }}" class="form">
        @csrf
        @method('PUT')

        <h3 class="section-title">Basic Information</h3>

        <div class="form-grid">

            <!-- Module -->
            <div class="form-group">
                <label>Module Name</label>
                <select name="module" required>
                    <option value="">-- Select Module --</option>
                    <option value="loan_officer" {{ old('module', $role->module) == 'loan_officer' ? 'selected' : '' }}>Karani</option>
                    <option value="accountant" {{ old('module', $role->module) == 'accountant' ? 'selected' : '' }}>Accountant</option>
                    <option value="users" {{ old('module', $role->module) == 'users' ? 'selected' : '' }}>Users</option>
                    <option value="roles" {{ old('module', $role->module) == 'roles' ? 'selected' : '' }}>Roles</option>
                </select>
            </div>

            <!-- Label -->
            <div class="form-group">
                <label>Role Label</label>
                <input type="text" name="lable"
                       value="{{ old('lable', $role->lable) }}"
                       required>
            </div>

            <!-- Description -->
            <div class="form-group full">
                <label>Description</label>
                <textarea name="description" rows="4">{{ old('description', $role->description) }}</textarea>
            </div>

        </div>

        <!-- PERMISSIONS -->
        <h3 class="section-title">Permissions</h3>

        <div class="permission-box">

            @foreach ($permissions as $module => $modulePermissions)

                <div class="module-title">
                    {{ ucfirst($module) }}
                </div>

                <div class="permission-grid">

                    @foreach ($modulePermissions as $permission)
                        <label class="checkbox-item">
                            <input type="checkbox"
                                   name="permissions[]"
                                   value="{{ $permission->id }}"
                                   {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                            <span>{{ $permission->label ?? $permission->name }}</span>
                        </label>
                    @endforeach

                </div>

            @endforeach

        </div>

        <!-- STATUS -->
        <h3 class="section-title">Status</h3>

        <div class="form-group">
            <label>Status</label>
            <select name="is_active" required>
                <option value="1" {{ old('is_active', $role->is_active) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active', $role->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
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