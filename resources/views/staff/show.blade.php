@extends('layouts.admin')

@section('content')

<style>
/* PAGE WRAPPER */
.profile-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

/* CARD */
.profile-card {
    width: 100%;
    max-width: 700px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    overflow: hidden;
}

/* HEADER */
.profile-header {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    padding: 25px;
    text-align: center;
}

.profile-header h2 {
    margin: 0;
    font-size: 22px;
}

.profile-header p {
    margin: 5px 0 0;
    opacity: 0.9;
}

/* BODY */
.profile-body {
    padding: 25px;
}

/* ROWS */
.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.info-box {
    background: #f8fafc;
    padding: 12px 15px;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
}

.info-box label {
    font-size: 12px;
    color: #64748b;
}

.info-box p {
    margin: 4px 0 0;
    font-weight: 600;
    color: #0f172a;
}

/* ROLE BADGE */
.role-badge {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    color: #fff;
    background: #10b981;
}

/* ACTIONS */
.actions {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
}

.btn {
    padding: 10px 14px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
}

.btn-back {
    background: #64748b;
    color: #fff;
}

.btn-edit {
    background: #f59e0b;
    color: #fff;
}
</style>

<div class="profile-wrapper">

    <div class="profile-card">

        <!-- HEADER -->
        <div class="profile-header">
            <h2>{{ $staff->first_name }} {{ $staff->last_name }}</h2>
            <p>Service Number: {{ $staff->force_number }}</p>
        </div>

        <!-- BODY -->
        <div class="profile-body">

            <div class="info-grid">

                <div class="info-box">
                    <label>Rank</label>
                    <p>{{ $staff->rank }}</p>
                </div>

                <div class="info-box">
                    <label>Department</label>
                    <p>{{ $staff->department }}</p>
                </div>

                <div class="info-box">
                    <label>Email</label>
                    <p>{{ $staff->email }}</p>
                </div>

                <div class="info-box">
                    <label>Phone</label>
                    <p>{{ $staff->phone }}</p>
                </div>

                <div class="info-box">
                    <label>Role</label>
                    <p>
                        <span class="role-badge">
                            {{ ucfirst(str_replace('_',' ', $staff->role)) }}
                        </span>
                    </p>
                </div>

            </div>

            <!-- ACTIONS -->
            <div class="actions">

                <a href="{{ route('staff.index') }}" class="btn btn-back">
                    ← Back
                </a>

                <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-edit">
                    Edit Staff
                </a>

            </div>

        </div>

    </div>

</div>

@endsection