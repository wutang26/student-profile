@section('content')

<style>
:root{
    --bg:#f5f7fb;
    --card:#ffffff;
    --text:#111827;
    --muted:#6b7280;
    --primary:#2563eb;
    --primary-dark:#1d4ed8;
    --border:#e5e7eb;
    --danger:#dc2626;
    --success-bg:#ecfdf5;
    --success:#047857;
    --radius:14px;
}

*{
    box-sizing:border-box;
}

body{
    margin:0;
    font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
    background: linear-gradient(135deg, #f5f7fb 0%, #eef2ff 100%);
    color:var(--text);
}

.page-wrapper{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:flex-start;
    padding:60px 20px;
}

.card{
    width:100%;
    max-width:720px;
    background:var(--card);
    border-radius:var(--radius);
    padding:32px;
    box-shadow: 0 20px 50px rgba(17,24,39,0.08);
    border:1px solid var(--border);
    backdrop-filter: blur(10px);
}

.header{
    margin-bottom:28px;
}

.title{
    font-size:24px;
    font-weight:700;
    letter-spacing:-0.5px;
}

.subtitle{
    font-size:13px;
    color:var(--muted);
    margin-top:4px;
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
    padding:12px 14px;
    border-radius:10px;
    border:1px solid var(--border);
    font-size:14px;
    outline:none;
    transition: all 0.2s ease;
    background:#fff;
}

input:focus{
    border-color:var(--primary);
    box-shadow:0 0 0 4px rgba(37,99,235,0.12);
}

.error{
    font-size:12px;
    color:var(--danger);
    margin-top:6px;
}

.alert-success{
    background:var(--success-bg);
    color:var(--success);
    padding:12px 14px;
    border-radius:10px;
    border:1px solid #a7f3d0;
    font-size:13px;
    margin-bottom:16px;
}

.note{
    font-size:13px;
    color:var(--muted);
    margin-top:10px;
    line-height:1.5;
    padding:10px 12px;
    background:#f9fafb;
    border-radius:10px;
    border:1px solid var(--border);
}

.btn{
    background:var(--primary);
    color:#fff;
    padding:12px 18px;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
    transition:0.2s;
    box-shadow: 0 8px 18px rgba(37,99,235,0.2);
}

.btn:hover{
    background:var(--primary-dark);
    transform: translateY(-1px);
}

.btn-secondary{
    background:transparent;
    border:none;
    color:var(--primary);
    cursor:pointer;
    font-size:13px;
    text-decoration:none;
    font-weight:600;
}

.btn-secondary:hover{
    text-decoration:underline;
}

.actions{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:24px;
    flex-wrap:wrap;
    gap:12px;
}

.badge{
    font-size:12px;
    padding:4px 10px;
    border-radius:999px;
    background:#eef2ff;
    color:#4338ca;
    font-weight:600;
}
</style>

<div class="page-wrapper">

    <div class="card">

        <!-- HEADER -->
        <div class="header">
            <div class="title">Profile Information</div>
            <div class="subtitle">Manage your account details and email settings</div>
        </div>

        <!-- SUCCESS -->
        @if(session('status') === 'profile-updated')
            <div class="alert-success">
                Profile updated successfully
            </div>
        @endif

        <!-- VERIFY FORM -->
        <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <!-- FORM -->
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
                        <br><br>

                        <button form="send-verification" class="btn-secondary">
                            Resend verification email
                        </button>

                        @if(session('status') === 'verification-link-sent')
                            <div class="alert-success" style="margin-top:10px;">
                                Verification link sent successfully
                            </div>
                        @endif
                    </div>
                @else
                    <div class="badge" style="margin-top:8px; display:inline-block;">
                        Verified
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
                        ✔ Changes saved
                    </span>
                @endif
            </div>

        </form>

    </div>

</div>

@endsection