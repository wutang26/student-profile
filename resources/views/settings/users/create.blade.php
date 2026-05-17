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

<style>
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
   FORM TITLE
========================= */
.form-title{
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #0f172a;
}

/* =========================
   FORM GRID
========================= */
.form-grid{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin-bottom: 15px;
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

/* INPUTS */
.form-group input,
.form-group select{
    padding: 10px 12px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: 14px;
    outline: none;
    transition: 0.2s;
    background: #fff;
}

.form-group input:focus,
.form-group select:focus{
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
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
   RESPONSIVE
========================= */
@media (max-width: 768px){
    .form-grid{
        grid-template-columns: 1fr;
    }
}
</style>

@endsection