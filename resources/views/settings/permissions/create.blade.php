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
<style>
        /* =========================
   ALERT ERROR BOX (SAFE UI)
========================= */
.alert-danger{
    background: #fee2e2;
    color: #991b1b;
    padding: 12px 16px;
    border-radius: 10px;
    margin-bottom: 15px;
    font-size: 14px;
    border-left: 4px solid #ef4444;
}

.alert-danger ul{
    margin-left: 18px;
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
   FORM CARD (CLEAN ADMIN LOOK)
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
   FORM TITLE
========================= */
.form-title{
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #0f172a;
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
   FORM GRID (FIX LAYOUT)
========================= */
.form-grid{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

/* FULL WIDTH SUPPORT */
.form-grid .form-group:nth-child(3){
    grid-column: 1 / -1; /* textarea full width */
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
    outline: none;
    transition: 0.2s;
    background: #fff;
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