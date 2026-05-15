@extends('layouts.admin')

@section('content')

<style>
    .card{
        background:#fff;
        padding:20px;
        border-radius:10px;
        box-shadow:0 2px 8px rgba(0,0,0,0.08);
        max-width:600px;
        margin:auto;
    }

    .form-group{
        margin-bottom:15px;
    }

    .form-group label{
        display:block;
        margin-bottom:5px;
        font-weight:600;
    }

    .form-control{
        width:100%;
        padding:10px;
        border:1px solid #ccc;
        border-radius:6px;
    }

    .btn-primary{
        background:#2563eb;
        color:white;
        border:none;
        padding:10px 16px;
        border-radius:6px;
        cursor:pointer;
    }

    .btn-primary:hover{
        background:#1d4ed8;
    }

    .alert-success{
        background:#d1fae5;
        color:#065f46;
        padding:10px;
        border-radius:6px;
        margin-bottom:15px;
    }
    .alert-danger{
    background:#fee2e2;
    color:#991b1b;
    padding:10px;
    border-radius:6px;
    margin-bottom:15px;
}

    .table{
        width:100%;
        border-collapse:collapse;
        margin-top:20px;
    }

    .table th,
    .table td{
        padding:10px;
        border-bottom:1px solid #eee;
        text-align:left;
    }

    .table th{
        background:#f3f4f6;
    }

</style>

<div class="card">

    <h2 style="margin-bottom:20px;">Register Course</h2>

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
    <!-- COURSE FORM -->
    <form method="POST" action="{{ route('courses.store') }}">
        @csrf

        <!-- COURSE NAME -->
        <div class="form-group">
            <label>Course Name</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   placeholder="Enter course name"
                   required>
        </div>

        <!-- INTAKE -->
        <div class="form-group">
            <label>Select Intake</label>

            <select name="intake" class="form-control" required>
                <option value="">-- Select Intake --</option>

                <option value="2025/2026">
                    2025/2026
                </option>

                <option value="2026/2027">
                    2026/2027
                </option>

                <option value="2027/2028">
                    2027/2028
                </option>
            </select>
        </div>

        <!-- BUTTON -->
        <button type="submit" class="btn-primary">
            Save Course
        </button>

    </form>

    <!-- COURSES TABLE -->
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
                    <td colspan="3">
                        No courses registered
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection