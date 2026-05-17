@extends('layouts.admin')

@section('content')

<style>
body{
    background: #f1f5f9;
    font-family: "Segoe UI", sans-serif;
}

/* CARD */
.card{
    background: #ffffff;
    padding: 28px;
    border-radius: 16px;
    max-width: 800px;
    margin: 40px auto;
    border: 1px solid #e2e8f0;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    position: relative;
    overflow: hidden;
}

.card::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    height:5px;
    width:100%;
    background: linear-gradient(90deg, #2563eb, #06b6d4);
}

.card h2{
    font-size: 22px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 20px;
}

/* FORM */
.form-group{
    margin-bottom: 18px;
}

.form-group label{
    display:block;
    margin-bottom:6px;
    font-weight:700;
    font-size: 13px;
    color: #334155;
}

.form-control{
    width:100%;
    padding:12px 14px;
    border:1px solid #cbd5e1;
    border-radius:10px;
    font-size:14px;
    transition:0.2s;
    background:#fff;
}

.form-control:focus{
    outline:none;
    border-color:#2563eb;
    box-shadow:0 0 0 3px rgba(37,99,235,0.15);
}

/* CENTER BUTTON WRAPPER (IMPORTANT FIX) */
.button-center{
    display:flex;
    justify-content:center;
    margin-top: 18px;
}

/* BUTTON */
.btn-primary{
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color:white;
    border:none;
    padding:11px 20px;
    border-radius:10px;
    font-weight:700;
    cursor:pointer;
    transition:0.2s;
    width: auto;
    display: inline-block;
}

.btn-primary:hover{
    transform: translateY(-2px);
    box-shadow:0 10px 20px rgba(37,99,235,0.25);
}

/* ALERTS */
.alert-success{
    background:#dcfce7;
    color:#166534;
    padding:12px 14px;
    border-radius:10px;
    margin-bottom:15px;
    border-left:4px solid #22c55e;
    font-weight:600;
}

.alert-danger{
    background:#fee2e2;
    color:#991b1b;
    padding:12px 14px;
    border-radius:10px;
    margin-bottom:15px;
    border-left:4px solid #ef4444;
}

/* TABLE */
.table{
    width:100%;
    border-collapse:collapse;
    margin-top:25px;
    overflow:hidden;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

.table th{
    background: linear-gradient(135deg, #1e293b, #334155);
    color:white;
    padding:14px;
    font-size:13px;
    text-align:left;
}

.table td{
    padding:14px;
    border-bottom:1px solid #e2e8f0;
    font-size:14px;
    color:#334155;
}

.table tbody tr:hover{
    background:#f8fafc;
}

.table td[colspan]{
    text-align:center;
    color:#64748b;
    padding:20px;
    font-style:italic;
}
</style>

<div class="card">

    <h2>Register Course</h2>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-danger">
            <ul style="margin:0; padding-left:18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM -->
    <form method="POST" action="{{ route('courses.store') }}">
        @csrf

        <div class="form-group">
            <label>Course Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Select Intake</label>
            <select name="intake" class="form-control" required>
                <option value="">-- Select Intake --</option>
                <option>2025/2026</option>
                <option>2026/2027</option>
                <option>2027/2028</option>
            </select>
        </div>

        <!-- CENTERED BUTTON -->
        <div class="button-center">
            <button type="submit" class="btn-primary">
                Save Course
            </button>
        </div>

    </form>

    <!-- TABLE -->
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Course Name</th>
                <th>Intake</th>
            </tr>
        </thead>

        <tbody>
            @forelse($courses as $key => $course)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->intake }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No courses registered</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection