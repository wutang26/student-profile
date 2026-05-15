@extends('layouts.admin')

@section('content')

<style>
body{
    margin:0;
    font-family:Arial, sans-serif;
    background:#f4f6f9;
}

.page-wrapper{
    min-height:80vh;
    display:flex;
    justify-content:center;
    align-items:flex-start;
    padding:40px 20px;
}

.card{
    width:100%;
    max-width:700px;
    background:#ffffff;
    border-radius:14px;
    padding:30px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    border:1px solid #e5e7eb;
}

.header{
    margin-bottom:25px;
}

.title{
    font-size:22px;
    font-weight:700;
    color:#111827;
    margin-bottom:5px;
}

.subtitle{
    font-size:13px;
    color:#6b7280;
}

.section{
    margin-bottom:18px;
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
    padding:12px;
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
    font-size:12px;
    color:#dc2626;
    margin-top:5px;
}

.alert-success{
    background:#ecfdf5;
    color:#047857;
    padding:10px 12px;
    border-radius:8px;
    border:1px solid #a7f3d0;
    font-size:13px;
    margin-bottom:15px;
}

.note{
    font-size:13px;
    color:#6b7280;
    margin-top:10px;
    line-height:1.5;
}

.btn{
    background:#2563eb;
    color:#fff;
    padding:12px 18px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
    transition:0.2s;
}

.btn:hover{
    background:#1d4ed8;
}

.btn-secondary{
    background:transparent;
    border:none;
    color:#2563eb;
    cursor:pointer;
    font-size:13px;
    text-decoration:underline;
}

.actions{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:20px;
    flex-wrap:wrap;
    gap:10px;
}
</style>

<div class="page-wrapper">

    <div class="card">

        <!-- HEADER -->
        <div class="header">
            <div class="title">👤 Profile Information</div>
            <div class="subtitle">Update your account details and email address</div>
        </div>

        <!-- SUCCESS MESSAGE -->
        @if(session('status') === 'profile-updated')
            <div class="alert-success">
                Profile updated successfully
            </div>
        @endif

        <!-- VERIFY FORM -->
        <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <!-- PROFILE FORM -->
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <!-- NAME -->
            <div class="section">
                <label>Name</label>
                <input type="text" name="name"
                       value="{{ old('name', $user->name) }}"
                       required>

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- EMAIL -->
            <div class="section">
                <label>Email</label>
                <input type="email" name="email"
                       value="{{ old('email', $user->email) }}"
                       required>

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="note">
                        ⚠ Your email is not verified.

                        <button form="send-verification" class="btn-secondary">
                            Resend verification email
                        </button>

                        @if(session('status') === 'verification-link-sent')
                            <div class="alert-success" style="margin-top:10px;">
                                Verification link sent successfully
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- ACTIONS -->
            <div class="actions">
                <button type="submit" class="btn">
                    Save Changes
                </button>

                @if(session('status') === 'profile-updated')
                    <span style="font-size:13px;color:#6b7280;">
                        ✔ Saved
                    </span>
                @endif
            </div>

        </form>

    </div>

</div>

@endsection