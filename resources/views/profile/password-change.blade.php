@extends('layouts.admin')

@section('content')

<style>
/* Page wrapper inside admin layout */
.page-wrap{
    display:flex;
    justify-content:center;
    padding:30px 20px;
}

/* Card */
.card{
    width:100%;
    max-width:520px;
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:16px;
    padding:28px;
    box-shadow:0 18px 45px rgba(0,0,0,0.06);
}

/* Header */
.title{
    font-size:20px;
    font-weight:700;
    margin-bottom:5px;
}

.subtitle{
    font-size:13px;
    color:#6b7280;
    margin-bottom:18px;
}

/* Inputs */
label{
    display:block;
    font-size:13px;
    font-weight:600;
    margin-bottom:6px;
    color:#374151;
}

input{
    width:100%;
    padding:12px 14px;
    border-radius:10px;
    border:1px solid #e5e7eb;
    outline:none;
    margin-bottom:14px;
    transition:0.2s;
}

input:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 4px rgba(37,99,235,0.12);
}

/* Button */
.btn{
    width:100%;
    background:#2563eb;
    color:#fff;
    border:none;
    padding:12px;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
    transition:0.2s;
}

.btn:hover{
    background:#1d4ed8;
}

/* Errors */
.error{
    font-size:12px;
    color:#dc2626;
    margin-top:-8px;
    margin-bottom:10px;
}

/* Success */
.success{
    background:#ecfdf5;
    color:#047857;
    padding:10px 12px;
    border-radius:10px;
    border:1px solid #a7f3d0;
    font-size:13px;
    margin-bottom:15px;
}
</style>

<div class="page-wrap">

    <div class="card">

        <div class="title">Change Password</div>
        <div class="subtitle">Update your password to keep your account secure
            
        </div>

        @if(session('status') === 'password-updated')
            <div class="success">✔ Password updated successfully


            </div>
        @endif

        <form method="POST" action="{{ route('password.change.update') }}">
            @csrf
            @method('PUT')

            <!-- CURRENT PASSWORD -->
            <label>Current Password</label>
            <input type="password" name="current_password" required>

            @error('current_password')
                <div class="error">{{ $message }}</div>
            @enderror

            <!-- NEW PASSWORD -->
            <label>New Password</label>
            <input type="password" name="password" required>

            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <!-- CONFIRM -->
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required>

            @error('password_confirmation')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn">
                Update Password
            </button>

        </form>

    </div>

</div>

@endsection