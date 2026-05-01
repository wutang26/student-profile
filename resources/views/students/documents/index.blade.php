@extends('layouts.admin')

@section('content')

<h2 class="page-title">
    <i class="bi bi-folder2-open"></i> Student Documents Type
</h2>

<a href="{{ route('students.documents.create') }}" class="btn-primary">
    <i class="bi bi-cloud-arrow-up"></i> Upload Document
</a>

<br><br>

<table class="table">
    <thead>
        <tr>
            <th>Force Number</th>
            <th>Student</th>
            <th>Type</th>
            <th>Title</th>
            <th>View or Read</th>
            <th>Comments</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($documents as $doc)
        <tr>
               <td>K.{{ $doc->student->force_number ?? '' }}</td>
            <td>{{ $doc->student->first_name ?? '' }}</td>
            <td>{{ ucfirst($doc->type) }}</td>
            <td>{{ $doc->title }}</td>

           <td>
            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-primary">
                <i class="bi bi-eye-fill"></i>
                <i class="bi bi-eye-fill"></i>
            </a>
        </td>

            <td>{{ $doc->remarks }}</td>

            <td>
                <form method="POST" action="{{ route('students.documents.destroy', $doc->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection