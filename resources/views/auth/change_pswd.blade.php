@extends('layouts.admin')

@section('content')

<style>
    .page-wrapper{
        padding:30px;
        display:flex;
        justify-content:center;
        align-items:center;
        min-height:70vh;
        background:#f4f6f9;
    }

    .card{
        width:100%;
        max-width:520px;
        background:#ffffff;
        border-radius:14px;
        box-shadow:0 10px 25px rgba(0,0,0,0.08);
        padding:30px;
        border:1px solid #eef0f3;
    }

    .title{
        font-size:20px;
        font-weight:700;
        margin-bottom:20px;
        color:#111827;
        text-align:center;
    }

    .alert-success{
        background:#ecfdf5;
        color:#047857;
        padding:10px 12px;
        border-radius:8px;
        font-size:13px;
        margin-bottom:15px;
        border:1px solid #a7f3d0;
    }

    .form-group{
        margin-bottom:16px;
    }

    label{
        display:block;
        font-size:13px;
        font-weight:600;
        margin-bottom:6px;
        color:#374151;
    }

    input{
        width:100%;
        padding:11px 12px;
        border-radius:8px;
        border:1px solid #d1d5db;
        font-size:14px;
        transition:0.2s;
        outline:none;
        background:#fff;
    }

    input:focus{
        border-color:#2563eb;
        box-shadow:0 0 0 3px rgba(37,99,235,0.15);
    }

    .error{
        color:#dc2626;
        font-size:12px;
        margin-top:5px;
    }

    .btn{
        width:100%;
        padding:12px;
        border:none;
        border-radius:8px;
        background:linear-gradient(135deg,#2563eb,#1d4ed8);
        color:#fff;
        font-weight:600;
        cursor:pointer;
        transition:0.2s;
        margin-top:10px;
    }

    .btn:hover{
        transform:translateY(-1px);
        box-shadow:0 8px 18px rgba(37,99,235,0.25);
    }
</style>


<div class="page-wrapper">

    <div class="card">

        <div class="title">
            🔒 Change Password
        </div>

        <!-- Success Message -->
        @if(session('status'))
            <div class="alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <!-- Current Password -->
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" required autofocus>
                @error('current_password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- New Password -->
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn">
                Update Password
            </button>

        </form>

    </div>

</div>

@endsection