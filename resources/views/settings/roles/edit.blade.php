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

<style>
    /* =========================
   FULL WIDTH FIELD FIX
========================= */
.full{
    grid-column: 1 / -1;
}

/* =========================
   FORM GRID IMPROVEMENT
========================= */
.form-grid{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

/* =========================
   FORM GROUP
========================= */
.form-group{
    display: flex;
    flex-direction: column;
}

/* LABEL */
.form-group label{
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #334155;
}

/* INPUTS + SELECT */
.form-group input,
.form-group select,
.form-group textarea{
    padding: 10px 12px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: 14px;
    outline: none;
    background: #fff;
    transition: 0.2s;
}

/* FOCUS */
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus{
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
}

/* =========================
   TEXTAREA FIX
========================= */
.form-group textarea{
    resize: vertical;
    min-height: 90px;
}

/* =========================
   PERMISSION SECTION FIX
========================= */
.permission-box{
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.module-title{
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
    margin-top: 10px;
}

.permission-grid{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 10px;
    padding: 10px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
}

/* CHECKBOX ITEM */
.checkbox-item{
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    padding: 6px 8px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.2s;
}

.checkbox-item:hover{
    background: #e2e8f0;
}

.checkbox-item input{
    width: 16px;
    height: 16px;
    accent-color: #2563eb;
}

/* =========================
   RESPONSIVE FIX
========================= */
@media (max-width: 768px){
    .form-grid{
        grid-template-columns: 1fr;
    }
}
</style>

@endsection