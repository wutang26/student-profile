@extends('layouts.admin')

@section('content')

<style>
    .page-wrapper{
        min-height:70vh;
        display:flex;
        justify-content:center;
        align-items:center;
        background:#f4f6f9;
        padding:30px;
    }

    .card{
        width:100%;
        max-width:520px;
        background:#fff;
        border-radius:14px;
        padding:30px;
        box-shadow:0 10px 25px rgba(0,0,0,0.08);
        border:1px solid #eef0f3;
    }

    .title{
        font-size:20px;
        font-weight:700;
        color:#111827;
        margin-bottom:6px;
        text-align:center;
    }

    .subtitle{
        font-size:13px;
        color:#6b7280;
        margin-bottom:18px;
        text-align:center;
        line-height:1.4;
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
        outline:none;
        transition:0.2s;
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

    .form-group{
        margin-top:14px;
    }

    .btn{
        width:100%;
        margin-top:20px;
        padding:12px;
        border:none;
        border-radius:8px;
        background:linear-gradient(135deg,#2563eb,#1d4ed8);
        color:#fff;
        font-weight:600;
        cursor:pointer;
        transition:0.2s;
    }

    .btn:hover{
        transform:translateY(-1px);
        box-shadow:0 8px 18px rgba(37,99,235,0.25);
    }
</style>

<div class="page-wrapper">

    <div class="card">

        <div class="title">
            🔁 Reset Password
        </div>

        <div class="subtitle">
            Create a new secure password for your account.
        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div class="form-group">
                <label>Email Address</label>
                <input type="email"
                       name="email"
                       value="{{ old('email', $request->email) }}"
                       required
                       autofocus>

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
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

                @error('password_confirmation')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">
                Reset Password
            </button>

        </form>

    </div>

</div>

@endsection