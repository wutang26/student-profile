@extends('layoutsGroup.groupdashboard')

@section('content')

<div class="card">
    <h2>Issue Group Loan</h2>

    <form method="POST" action="{{ route('loans.store') }}">
        @csrf

        <label>Group</label>
        <select name="group_id">
            @foreach($groups as $group)
                <option value="{{ $group->id }}">{{ $group->name }}</option>
            @endforeach
        </select>

        <input type="number" name="total_amount" placeholder="Amount">
        <input type="number" name="interest_rate" placeholder="Interest %">
        <input type="number" name="duration" placeholder="Duration (months)">
        <input type="date" name="start_date">

        <button class="btn">Issue Loan</button>
    </form>
</div>

@endsection