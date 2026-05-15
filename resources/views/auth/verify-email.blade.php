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
        max-width:560px;
        background:#fff;
        border-radius:14px;
        padding:30px;
        box-shadow:0 10px 25px rgba(0,0,0,0.08);
        border:1px solid #eef0f3;
        text-align:center;
    }

    .title{
        font-size:20px;
        font-weight:700;
        color:#111827;
        margin-bottom:10px;
    }

    .text{
        font-size:13px;
        color:#6b7280;
        line-height:1.5;
        margin-bottom:18px;
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

    .btn-group{
        display:flex;
        justify-content:space-between;
        gap:10px;
        margin-top:20px;
        flex-wrap:wrap;
    }

    .btn{
        flex:1;
        padding:11px;
        border:none;
        border-radius:8px;
        font-weight:600;
        cursor:pointer;
        transition:0.2s;
        text-decoration:none;
        text-align:center;
    }

    .btn-primary{
        background:linear-gradient(135deg,#2563eb,#1d4ed8);
        color:#fff;
    }

    .btn-primary:hover{
        transform:translateY(-1px);
        box-shadow:0 8px 18px rgba(37,99,235,0.25);
    }

    .btn-danger{
        background:#ef4444;
        color:#fff;
    }

    .btn-danger:hover{
        background:#dc2626;
    }
</style>

<div class="page-wrapper">

    <div class="card">

        <div class="title">
            📧 Email Verification
        </div>

        <div class="text">
            Thanks for signing up! Before getting started, please verify your email address by clicking the link we sent you.  
            If you didn’t receive it, you can request another.
        </div>

        <!-- Success Message -->
        @if (session('status') == 'verification-link-sent')
            <div class="alert-success">
                A new verification link has been sent to your email address.
            </div>
        @endif

        <div class="btn-group">

            <!-- Resend Email -->
            <form method="POST" action="{{ route('verification.send') }}" style="flex:1;">
                @csrf
                <button type="submit" class="btn btn-primary">
                    Resend Email
                </button>
            </form>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" style="flex:1;">
                @csrf
                <button type="submit" class="btn btn-danger">
                    Logout
                </button>
            </form>

        </div>

    </div>

</div>

@endsection