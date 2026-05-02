@extends('layouts.admin')

@section('content')

<style>
    .btn-primary{
        background:#6B8F99;;
        color:#fff;
        padding:7px 12px;
        border-radius:6px;
        text-decoration:none;
        border:none;
        cursor:pointer;
        font-size:14px;
    }

    .btn-primary:hover{
        background:#1d4ed8;
    }

    .table-container{
        background:#fff;
        padding:10px;
        border-radius:10px;
        box-shadow:0 2px 8px rgba(0,0,0,0.08);
        overflow-x:auto;
    }

    .table{
        width:100%;
        border-collapse:collapse;
        font-size:14px;
    }

    .table th, .table td{
        padding:10px;
        border-bottom:1px solid #eee;
        text-align:left;
        white-space:nowrap;
    }

    .table tr:hover{
        background:#f9fafb;
    }

    .alert-success{
        background:#d1fae5;
        color:#065f46;
        padding:10px;
        border-radius:6px;
        margin-bottom:10px;
    }

    .status{
        padding:3px 8px;
        border-radius:20px;
        font-size:12px;
    }

    .status.active{
        background:#dcfce7;
        color:#166534;
    }

    .status.inactive{
        background:#fee2e2;
        color:#991b1b;
    }

    .action-btns{
        display:flex;
        gap:5px;
    }

    .btn-view{
        background:#0ea5e9;
        color:#fff;
        padding:5px 10px;
        border-radius:6px;
        text-decoration:none;
        font-size:12px;
    }

    .btn-view:hover{
        background:#0284c7;
    }

    .upload-box{
        background:#fff;
        padding:10px;
        border-radius:10px;
        margin-top:10px;
        box-shadow:0 2px 8px rgba(0,0,0,0.08);
    }
</style>
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
    
    <h1 class="page-title" style="margin:0;">Students List</h1>

    <!-- Search Form (Top Right) -->
    <form method="GET" action="{{ route('students.index') }}" style="display:flex; gap:5px;">
        <input 
            type="text" 
            name="search" 
            placeholder="Search student..." 
            value="{{ request('search') }}"
            style="padding:6px 10px; border:1px solid #ccc; border-radius:5px;"
        >

        <button type="submit" class="btn-primary">
            Search
        </button>
    </form>

</div>

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

@can('view students')
<a href="{{ route('students.create') }}" class="btn-primary">
    <i class="bi bi-person"></i> Register Student
</a>  
@endcan

<div class="upload-box" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;">

    <!-- LEFT: UPLOAD FORM -->
     
@can('view students')
    <form method="POST" action="{{ route('students.import') }}" enctype="multipart/form-data"
          style="display:flex; align-items:center; gap:10px;">
        @csrf

        <label style="font-weight:600;">Upload Excel File:</label>

        <input type="file" name="file" required>

        <button type="submit" class="btn-primary">
            Upload Students
        </button>
    </form>
@endcan

    <!-- RIGHT: TOTAL COUNT -->
    <div style="
        display:flex;
        align-items:center;
        gap:6px;
        background:#f3f4f6;
        padding:6px 12px;
        border-radius:20px;
        font-weight:600;
        white-space:nowrap;
    ">
        Total:
        <span style="
            background:#2563eb;
            color:#fff;
            padding:2px 10px;
            border-radius:20px;
            font-size:12px;
        ">
            {{ $students->count() }}
        </span>
    </div>

</div>
<br>

<div class="table-container">
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Force No</th>
            <th>Name</th>
            <th>NIDA</th>
            <th>Company</th>
            <th>Platoon</th>
            <th>Phone</th>
            <th>Status</th>
             <th>More Details</th>
        </tr>
    </thead>

    <tbody>
        @foreach($students as $key => $student)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $student->force_number }}</td>
            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
            <td>{{ $student->nida }}</td>
            <td>{{ $student->company }}</td>
            <td>{{ $student->platoon }}</td>
            <td>{{ $student->phone }}</td>
            <td>
                <span class="status {{ $student->status }}">
                    {{ $student->status }}
                </span>
            </td>
            <td>
            <div class="action-btns">

                <!-- VIEW DETAILS -->
                <a href="{{ route('students.show', $student->id) }}" class="btn-view">
                    View
                </a>

            </div>
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection