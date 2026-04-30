@extends('layoutsGroup.groupdashboard')

@section('content')

<div class="profile-card">

    <div class="profile-header">
        <img src="{{ $student->photo ?? 'https://via.placeholder.com/120' }}" class="profile-img">

        <div>
            <h1>{{ $student->full_name }}</h1>
            <p>{{ $student->force_number }}</p>

            <span class="status {{ $student->status }}">
                {{ $student->status }}
            </span>
        </div>
    </div>

    <div class="profile-grid">

        <div>
            <h4>Phone</h4>
            <p>{{ $student->phone }}</p>
        </div>

        <div>
            <h4>Next of Kin</h4>
            <p>{{ $student->next_of_kin }}</p>
        </div>

        <div>
            <h4>Origin Region</h4>
            <p>{{ $student->origin_region }}</p>
        </div>

        <div>
            <h4>Entry Region</h4>
            <p>{{ $student->entry_region }}</p>
        </div>

    </div>

    <div class="comment">
        <h4>Comment</h4>
        <p>{{ $student->comment ?? 'No comment available' }}</p>
    </div>

</div>

@endsection