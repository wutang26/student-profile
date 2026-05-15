@extends('layouts.admin')

@section('content')

<style>
.page-wrap{
    padding:30px 20px;
    display:flex;
    justify-content:center;
}

.container{
    width:100%;
    max-width:900px;
}

/* Header */
.page-title{
    font-size:22px;
    font-weight:700;
    margin-bottom:4px;
}

.page-subtitle{
    font-size:13px;
    color:#6b7280;
    margin-bottom:20px;
}

/* Cards */
.card{
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:16px;
    padding:26px;
    box-shadow:0 18px 45px rgba(0,0,0,0.06);
    margin-bottom:18px;
    transition:0.2s;
}

.card:hover{
    transform:translateY(-2px);
}

/* inner width */
.inner{
    max-width:520px;
}

/* section title */
.section-title{
    font-size:16px;
    font-weight:600;
    margin-bottom:10px;
}
</style>

<div class="page-wrap">

    <div class="container">

        <!-- HEADER -->
        <div class="page-title">Profile Settings</div>
        <div class="page-subtitle">
            Manage your account information, password, and security
        </div>

        <!-- PROFILE INFO -->
        <div class="card">
            <div class="inner">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- PASSWORD -->
        <div class="card">
            <div class="inner">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- DELETE ACCOUNT -->
        <div class="card" style="border:1px solid #fee2e2;">
            <div class="inner">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>

</div>

@endsection