@extends('layouts.admin')

@section('content')

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

<a href="{{ route('students.create') }}" class="btn-primary">
    <i class="bi bi-person"></i> Register Student
</a>  
<br><br>

<div class="table-container">
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Force No</th>
            <th>NIDA</th>
            <th>Company</th>
            <th>Platoon</th>
            <th>Phone</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach($students as $key => $student)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
            <td>{{ $student->force_number }}</td>
            <td>{{ $student->nida }}</td>
            <td>{{ $student->company }}</td>
            <td>{{ $student->platoon }}</td>
            <td>{{ $student->phone }}</td>
            <td>
                <span class="status {{ $student->status }}">
                    {{ $student->status }}
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection