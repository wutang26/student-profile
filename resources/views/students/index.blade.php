@extends('layouts.admin')

@section('content')

<h1 class="page-title">Students List</h1>

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('students.create') }}" class="btn-primary">
    + Register Student
</a>  <br><br>

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