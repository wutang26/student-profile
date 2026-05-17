@extends('layouts.admin')

@section('content')

@if ($errors->any())
    <div class="alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h1 class="page-title">Dashboard</h1>

<!-- BACK -->
<div class="back-link">
    <a href="{{ route('settings.users.index') }}">&larr; Back</a>
</div>

<!-- CARD -->
<div class="form-card">

    <h2 class="form-title">Edit User</h2>

    <form method="POST" action="{{ route('settings.users.updateUser', $user->id) }}" class="form">
        @csrf
        @method('PUT')

        <h3 class="section-title">Basic Information</h3>

        <div class="form-grid">

            <!-- Name -->
            <div class="form-group">
                <label>User Name</label>
                <input type="text" name="name"
                       value="{{ old('name', $user->name) }}"
                       required>
            </div>

            <!-- User Type -->
            <div class="form-group">
                <label>User Type (Role)</label>
                <input type="text" name="usertype"
                       value="{{ old('usertype', $user->usertype) }}"
                       required>
            </div>

        </div>

        <!-- EMAIL + STATUS -->
        <div class="form-grid">

            <!-- Email -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                       value="{{ old('email', $user->email) }}"
                       required>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

        </div>

        <!-- PASSWORD -->
        <div class="form-grid">

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Leave blank to keep current password">
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Leave blank to keep current password">
            </div>

        </div>

        <!-- BUTTON -->
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                Update User
            </button>
        </div>

    </form>

</div>

<style>
        /* =========================
   ALERT ERROR BOX
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