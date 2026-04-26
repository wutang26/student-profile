@extends('layoutsGroup.groupdashboard')

@section('content')

<div class="card">
    <h3><i class="fas fa-hand-holding-dollar"></i> Issue Group Loan</h3>

    <form method="POST" action="{{ route('loans.store') }}">
        @csrf

        <!-- ROW 1 -->
        <div class="row">
            <div class="col-12 form-group">
                <label>Group</label>
                <select name="group_id" required>
                    <option value="">-- Select Group --</option>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- ROW 2 -->
        <div class="row">
            <div class="col-6 form-group">
                <label>Total Amount</label>
                <input type="number" name="total_amount" placeholder="Enter amount" required>
            </div>

            <div class="col-6 form-group">
                <label>Interest Rate (%)</label>
                <input type="number" name="interest_rate" placeholder="e.g. 10%" required>
            </div>
        </div>

        <!-- ROW 3 -->
        <div class="row">
            <div class="col-6 form-group">
                <label>Duration (Months)</label>
                <input type="number" name="duration" placeholder="e.g. 12 months" required>
            </div>

            <div class="col-6 form-group">
                <label>Start Date</label>
                <input type="date" name="start_date" required>
            </div>
        </div>

        <!-- BUTTON -->
        <div class="form-group">
            <button type="submit" class="btn">
                <i class="fas fa-paper-plane"></i> Issue Loan
            </button>
        </div>

    </form>
</div>

@endsection