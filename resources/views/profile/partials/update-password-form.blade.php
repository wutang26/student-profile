<section class="card-section">

<style>
.card-section{
    margin-top:24px;
    padding:24px;
    border:1px solid #e5e7eb;
    border-radius:14px;
    background:#fff;
    box-shadow:0 10px 30px rgba(17,24,39,0.06);
}

.section-header{
    margin-bottom:18px;
}

.section-title{
    font-size:18px;
    font-weight:700;
    color:#111827;
}

.section-subtitle{
    font-size:13px;
    color:#6b7280;
    margin-top:4px;
    line-height:1.4;
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
    padding:12px 14px;
    border-radius:10px;
    border:1px solid #e5e7eb;
    font-size:14px;
    outline:none;
    transition:0.2s;
    background:#fff;
}

input:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 4px rgba(37,99,235,0.12);
}

.error-text{
    font-size:12px;
    color:#dc2626;
    margin-top:6px;
}

.actions{
    display:flex;
    align-items:center;
    gap:12px;
    margin-top:10px;
}

.btn-primary{
    background:#2563eb;
    color:#fff;
    padding:11px 16px;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
    transition:0.2s;
    box-shadow:0 8px 18px rgba(37,99,235,0.18);
}

.btn-primary:hover{
    background:#1d4ed8;
    transform:translateY(-1px);
}

.success-text{
    font-size:13px;
    color:#047857;
    background:#ecfdf5;
    padding:8px 12px;
    border-radius:10px;
    border:1px solid #a7f3d0;
}
</style>

<div class="section-header">
    <div class="section-title">Update Password</div>
    <div class="section-subtitle">
        Use a strong, random password to keep your account secure.
    </div>
</div>

<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <!-- CURRENT PASSWORD -->
    <div class="form-group">
        <label>Current Password</label>
        <input type="password"
               name="current_password"
               autocomplete="current-password">

        @error('current_password', 'updatePassword')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <!-- NEW PASSWORD -->
    <div class="form-group">
        <label>New Password</label>
        <input type="password"
               name="password"
               autocomplete="new-password">

        @error('password', 'updatePassword')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <!-- CONFIRM PASSWORD -->
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password"
               name="password_confirmation"
               autocomplete="new-password">

        @error('password_confirmation', 'updatePassword')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <!-- ACTIONS -->
    <div class="actions">
        <button type="submit" class="btn-primary">
            Save Password
        </button>

        @if (session('status') === 'password-updated')
            <div class="success-text">
                ✔ Password updated successfully
            </div>
        @endif
    </div>

</form>

</section>