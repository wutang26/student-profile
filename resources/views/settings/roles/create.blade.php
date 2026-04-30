@extends('layouts.admin')

@section('content')

<h1 class="page-title">Dashboard</h1>

<!-- BACK -->
<div class="back-link">
    <a href="{{ route('settings.roles.index') }}">&larr; Back</a>
</div>

<!-- CARD -->
<div class="form-card">

    <h2 class="form-title">Register Role</h2>

    <form method="POST" action="{{ route('settings.roles.storeRole') }}" class="form">
        @csrf

        <h3 class="section-title">Basic Information</h3>

        <div class="form-grid">

            <!-- Role Name -->
            <div class="form-group">
                <label>Role Name</label>
                <input type="text" name="lable" required>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label>Description</label>
                <textarea name="description"></textarea>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label>Status</label>
                <select name="is_active" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

        </div>

        <!-- PERMISSIONS -->
        <h3 class="section-title">Permissions</h3>

        <div class="permission-box">

            @foreach ($permissions as $module => $modulePermissions)

                <div class="module-card">

                    <div class="module-title">
                        {{ ucfirst($module) }}
                    </div>

                    <div class="permission-grid">

                        @foreach ($modulePermissions as $permission)
                            <label class="checkbox-item">
                                <input type="checkbox"
                                       name="permissions[]"
                                       value="{{ $permission->id }}">
                                <span>{{ $permission->label ?? $permission->name }}</span>
                            </label>
                        @endforeach

                    </div>

                </div>

            @endforeach

        </div>

        <!-- BUTTON -->
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                Save Role
            </button>
        </div>

    </form>

</div>

@endsection