@extends('layoutsGroup.groupdashboard')

@section('content')

<div class="card">
    <h2>Groups</h2>
    <a href="{{ route('groups.create') }}" class="btn">+ Create Group</a>


     <h2>See Members</h2>
    <a href="{{ route('admin.members.index') }}" class="btn">+ Register Members</a>


    <table>
        <tr>
            <th>Name</th>
            <th>Description</th>
        </tr>

        @foreach($groups as $group)
        <tr>
            <td>{{ $group->name }}</td>
            <td>{{ $group->description }}</td>
        </tr>
        @endforeach
    </table>
</div>

@endsection