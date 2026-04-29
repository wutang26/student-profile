@extends('layoutsGroup.groupdashboard')

@section('content')

<div class="row" style="gap:20px;">

    <!-- 🔵 GROUP HEADER CARD -->
    <div class="card col-12" style="padding:25px; border-radius:16px; background:linear-gradient(135deg,#0f172a,#1e293b); color:white;">
        
        <div style="display:flex; justify-content:space-between; align-items:center;">
            
            <div>
                <h2 style="margin:0; font-size:26px;">{{ $group->name }}</h2>
                <p style="margin-top:5px; color:#cbd5e1;">{{ $group->description }}</p>
            </div>

            <div style="text-align:right;">
                <div style="font-size:14px; color:#94a3b8;">Members</div>
                <div style="font-size:22px; font-weight:bold;">
                    {{ $group->users->count() }}
                </div>
            </div>

        </div>

    </div>


    <!-- 🟢 LOAN RULES CARD -->
    <div class="card col-12" style="padding:20px; border-radius:16px;">

        <h3 style="margin-bottom:15px;">📌 Loan Rules</h3>

        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:15px;">

            <div style="background:#f1f5f9; padding:15px; border-radius:12px;">
                <small>Interest Rate</small>
                <h4 style="margin:5px 0;">{{ $group->interest_rate ?? '5%' }}</h4>
            </div>

            <div style="background:#f1f5f9; padding:15px; border-radius:12px;">
                <small>Max Loan</small>
                <h4 style="margin:5px 0;">{{ $group->max_loan ?? 'Flexible' }}</h4>
            </div>

            <div style="background:#f1f5f9; padding:15px; border-radius:12px;">
                <small>Repayment</small>
                <h4 style="margin:5px 0;">{{ $group->repayment_period ?? '6 months' }}</h4>
            </div>

        </div>

    </div>


    <!-- 🟣 LOAN REQUEST FORM -->
    <div class="card col-12" style="padding:20px; border-radius:16px;">

        <h3 style="margin-bottom:15px;">💰 Request Loan</h3>

        <form method="POST" action="{{ route('loans.store') }}">

            @csrf

            <input type="hidden" name="group_id" value="{{ $group->id }}">

            <!-- Amount -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:500;">Amount</label>
                <input type="number" name="amount" required
                    style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:10px;">
            </div>

            <!-- Purpose -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:500;">Purpose</label>
                <textarea name="purpose" required
                    style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:10px;"></textarea>
            </div>

            <!-- Repayment -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:500;">Repayment Plan</label>
                <select name="repayment_months"
                    style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:10px;">
                    <option value="3">3 Months</option>
                    <option value="6">6 Months</option>
                    <option value="12">12 Months</option>
                </select>
            </div>

           <!-- Button -->
            <div style="display:flex; justify-content:center; margin-top:10px;">
                <button type="submit"
                    style="background:#2563eb; color:white; padding:12px 30px; border:none; border-radius:10px; cursor:pointer; font-weight:600;">
                    Submit Loan Request
                </button>
            </div>

        </form>

    </div>

</div>

@endsection