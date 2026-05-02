@extends('layouts.admin')

@section('content')

<style>
/* PAGE HEADER */
.page-header {
    margin-bottom: 20px;
}
.page-header h2 {
    margin: 0;
    font-size: 22px;
}
.subtitle {
    color: #64748b;
    font-size: 14px;
}

/* FORM CONTAINER */
.form-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* CARD STYLE */
.form-card {
    background: #ffffff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.form-card h3 {
    margin-bottom: 15px;
    font-size: 16px;
    color: #334155;
}

/* GRID */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 15px;
}

/* INPUTS */
.form-grid input,
.form-grid select {
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    font-size: 14px;
    transition: 0.2s;
}

.form-grid input:focus,
.form-grid select:focus {
    border-color: #3b82f6;
    outline: none;
}

/* BUTTON */
.form-actions {
    text-align: right;
}

.btn-primary {
    background: #3b82f6;
    color: #fff;
    padding: 10px 18px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

.btn-primary:hover {
    background: #2563eb;
}
</style>

<div class="page-header">
    <h2><i class="bi bi-person-badge"></i> Staff Registration</h2> &nbsp;&nbsp;&nbsp;
    <p class="subtitle">Register new military school staff or Leader</p>
</div>

<form method="POST" action="{{ route('staff.store') }}" class="form-container">
@csrf

    <!-- ===== PERSONAL INFO ===== -->
    <div class="form-card">
        <h3><i class="bi bi-person"></i> Personal Information</h3>

        <div class="form-grid">
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="middle_name" placeholder="Middle Name">
            <input type="text" name="last_name" placeholder="Last Name" required>
        </div>
    </div>

    <!-- ===== MILITARY INFO ===== -->
    <div class="form-card">
        <h3><i class="bi bi-shield"></i> Military Details</h3>

        <div class="form-grid">
            <input type="text" name="force_number" placeholder="Service Number" required>
            <input type="text" name="rank" placeholder="Rank">
            <input type="text" name="department" placeholder="Department">
        </div>
    </div>

    <!-- ===== CONTACT INFO ===== -->
    <div class="form-card">
        <h3><i class="bi bi-telephone"></i> Contact Information</h3>

        <div class="form-grid">
            <input type="text" name="phone" placeholder="Phone">
            <input type="email" name="email" placeholder="Email" required>
        </div>
    </div>

    <!-- ===== ROLE & SECURITY ===== -->
    <div class="form-card">
        <h3><i class="bi bi-lock"></i> Role & Security</h3>

        <div class="form-grid">
            <select name="role" required>
                <option value="">Select Role</option>
                <option value="karani">Karani</option>
                <option value="katibu">Katibu</option>
                <option value="company_sergeant_major">Company Sergeant Major</option>
                <option value="instructor">Instructor</option>
                <option value="adjutant">Adjutant</option>
                <option value="chiefinstructor">Chief Instructor</option>
                <option value="chiefmatron">Chief Matron</option>
                <option value="commandant">Commandant</option>
                <option value="admin">Admin</option>
            </select>

            <input type="password" name="password" placeholder="Password" required>
        </div>
    </div>

    <!-- ===== ACTION ===== -->
    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="bi bi-check-circle"></i> Register Staff
        </button>
    </div>

</form>

@endsection