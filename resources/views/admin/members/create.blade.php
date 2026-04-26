@extends('layoutsGroup.groupdashboard')

@section('content')

<div class="row">

    <!-- HEADER -->
    <div class="card col-12" style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h2 style="margin-bottom:5px;">Register New Member</h2>
            <p style="color:#64748b; font-size:14px;">Add a new member to the system</p>
        </div>

        <a href="{{ route('admin.members.index') }}" class="btn" style="background:#334155;">
            ← Back
        </a>
    </div>

    <!-- FORM -->
    <div class="card col-12">

        <form method="POST" action="{{ route('members.store') }}">
            @csrf

            <!-- ===== BASIC INFO ===== -->
            <h3 style="margin-bottom:10px;">Basic Information</h3>

            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label>Member Reg. No.</label>
                        <input type="text" name="member_number" required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Date Joined</label>
                        <input type="date" name="date_joined" max="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="middle_name">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" required>
                    </div>
                </div>

            </div>

            <!-- ===== LOCATION ===== -->
            <h3 style="margin:20px 0 10px;">Location</h3>

            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label>Region</label>
                        <select name="region_id" required>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>District</label>
                        <select name="district_id" required>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Home Address</label>
                        <input type="text" name="address" required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" required>
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                </div>

            </div>

            <!-- BUTTON -->
            <div style="margin-top:20px; display:flex; justify-content:flex-end;">
                <button class="btn">
                    <i class="fas fa-save"></i> Save Member
                </button>
            </div>

        </form>

    </div>

</div>

@endsection