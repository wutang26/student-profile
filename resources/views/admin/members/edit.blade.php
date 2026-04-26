@extends('layoutsGroup.groupdashboard')

@section('content')

<div class="row">

    <!-- HEADER -->
    <div class="card col-12" style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h2 style="margin-bottom:5px;">Edit Member</h2>
            <p style="color:#64748b; font-size:14px;">Update member information</p>
        </div>

        <a href="{{ route('admin.members.index') }}" class="btn" style="background:#334155;">
            ← Back
        </a>
    </div>

    <!-- FORM -->
    <div class="card col-12">

        <form method="POST" action="{{ route('admin.members.update', $member->id) }}">
            @csrf
            @method('PUT')

            <!-- ===== BASIC INFO ===== -->
            <h3 style="margin-bottom:10px;">Basic Information</h3>

            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label>Member Reg. No.</label>
                        <input type="text" name="member_number"
                               value="{{ old('member_number', $member->member_number) }}" required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Date Joined</label>
                        <input type="date" name="date_joined"
                               value="{{ old('date_joined', $member->date_joined) }}" required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name"
                               value="{{ old('first_name', $member->first_name) }}" required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="middle_name"
                               value="{{ old('middle_name', $member->middle_name) }}">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name"
                               value="{{ old('last_name', $member->last_name) }}" required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone"
                               value="{{ old('phone', $member->phone) }}" required>
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
                                <option value="{{ $region->id }}"
                                    {{ $member->region_id == $region->id ? 'selected' : '' }}>
                                    {{ $region->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>District</label>
                        <select name="district_id" required>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}"
                                    {{ $member->district_id == $district->id ? 'selected' : '' }}>
                                    {{ $district->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Home Address</label>
                        <input type="text" name="address"
                               value="{{ old('address', $member->address) }}" required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" required>
                            <option value="active" {{ $member->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $member->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="pending" {{ $member->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>
                </div>

            </div>

            <!-- BUTTON -->
            <div style="margin-top:20px; display:flex; justify-content:flex-end;">
                <button class="btn">
                    <i class="fas fa-save"></i> Update Member
                </button>
            </div>

        </form>

    </div>

</div>

@endsection