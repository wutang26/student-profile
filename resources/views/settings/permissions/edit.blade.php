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
<style>
        /* =========================
   FORM CARD (CONSISTENT)
========================= */
.form-card{
    background: #fff;
    padding: 30px;
    border-radius: 14px;
    border: 1px solid #eef2f7;
    box-shadow: 0 8px 20px rgba(15, 23, 42, 0.05);
    max-width: 900px;
    margin: auto;
}

/* =========================
   FORM GRID
========================= */
.form-grid{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

/* =========================
   FULL WIDTH FIX (TEXTAREA)
========================= */
.form-grid .form-group:nth-child(3){
    grid-column: 1 / -1;
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

/* INPUTS / SELECT / TEXTAREA */
.form-group input,
.form-group select,
.form-group textarea{
    padding: 10px 12px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: 14px;
    background: #fff;
    outline: none;
    transition: 0.2s;
}

/* FOCUS EFFECT */
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus{
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
}

/* TEXTAREA FIX */
.form-group textarea{
    resize: vertical;
    min-height: 90px;
}

/* =========================
   SECTION TITLE
========================= */
.section-title{
    font-size: 16px;
    font-weight: 700;
    margin: 20px 0 10px;
    color: #1e293b;
    border-left: 4px solid #2563eb;
    padding-left: 10px;
}

/* =========================
   BACK LINK
========================= */
.back-link{
    margin-bottom: 15px;
}

.back-link a{
    text-decoration: none;
    color: #2563eb;
    font-size: 14px;
    font-weight: 600;
}

.back-link a:hover{
    text-decoration: underline;
}

/* =========================
   BUTTON
========================= */
.btn-primary{
    background: linear-gradient(135deg, #1d4ed8, #2563eb);
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
}

.btn-primary:hover{
    opacity: 0.9;
    transform: translateY(-1px);
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 768px){
    .form-grid{
        grid-template-columns: 1fr;
    }
}
</style>
@endsection