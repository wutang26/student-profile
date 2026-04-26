@extends('layoutsGroup.groupdashboard')

@section('content')

<div class="card">
    <h2>Create Group</h2>

    <form method="POST" action="{{ route('groups.store') }}">
        @csrf

        <input type="text" name="name" placeholder="Group Name">
        <textarea name="description" placeholder="Description"></textarea>

        <h4>Members</h4>

        @foreach($users as $user)
            <div>
                {{ $user->name }}
                <input type="number" name="users[{{ $user->id }}]" placeholder="Share %">
            </div>
        @endforeach

        <button class="btn">Save</button>
    </form>
</div>

@endsection