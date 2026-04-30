@extends('layoutsGroup.groupdashboard')

@section('content')

<div class="page-header">
    <h1>Students</h1>

    <!-- Search -->
    <form method="GET" class="search-box">
        <input type="text" name="search" placeholder="Search student...">
        <button type="submit">Search</button>
    </form>
</div>

<!-- GRID -->
<div class="student-grid">

    @foreach($students as $student)
    <div class="student-card">

        <img src="{{ $student->photo ?? 'https://via.placeholder.com/100' }}" class="avatar">

        <h2>{{ $student->full_name }}</h2>
        <p class="force">{{ $student->force_number }}</p>

        <span class="status {{ $student->status }}">
            {{ $student->status }}
        </span>

        <a href="{{ route('students.show', $student->id) }}" class="view-btn">
            View Profile
        </a>

    </div>
    @endforeach

</div>

<div class="pagination">
    {{ $students->links() }}
</div>

@endsection