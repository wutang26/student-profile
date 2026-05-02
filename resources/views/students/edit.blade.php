@extends('layouts.admin')

@section('content')

<h1 class="page-title">Register Student</h1>

<form method="POST" action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data">
@csrf
@method('PUT')

<!-- ================= BASIC INFO ================= -->
<div class="form-section">
    <h3 class="section-title">Basic Information</h3>

    <div class="grid">
        <input type="text" name="first_name" placeholder="First Name" required value="{{ $student->first_name }}">
        <input type="text" name="middle_name" placeholder="Middle Name" value="{{ $student->middle_name }}">
        <input type="text" name="last_name" placeholder="Last Name" value="{{ $student->last_name }}">

        <input type="text" name="force_number" placeholder="Force Number" required value="{{ $student->force_number }}">
        <input type="text" name="nida" placeholder="NIDA" required value="{{ $student->nida }}">
        <input type="date" name="date_of_birth" value="{{ $student->date_of_birth }}">

        <select name="gender">
            <option value="">Select Gender</option>
            <option>Male</option>
            <option>Female</option>
        </select>
    </div>
</div>

<!-- ================= COMPANY ================= -->
<div class="form-section">
    <h3 class="section-title">Company & Platoon</h3>

    <div class="grid">
        <select name="company" required value="{{ $student->company }}">
            <!-- <option value="">Select Company</option> -->
             <option value="HQ-Coy" {{ $student->company == 'HQ-Coy' ? 'selected' : '' }}>HQ-Coy</option>
             <option value="A-Coy" {{ $student->company == 'A-Coy' ? 'selected' : '' }}>A-Coy</option>
            <option>B-Coy</option>
            <option>C-Coy</option>
            <option>D-Coy</option>
        </select>

        <select name="platoon" required value="{{ $student->platoon }}">
            <!-- <option value="">Select Platoon</option> -->
            @for($i = 1; $i <= 18; $i++)
                <option value="Platoon {{ $i }}">Platoon {{ $i }}</option>
            @endfor
        </select>
    </div>
</div>

<!-- ================= CONTACT ================= -->
<div class="form-section">
    <h3 class="section-title">Contact Details</h3>

    <div class="grid">
        <input type="text" name="phone" placeholder="Phone" value="{{ $student->phone }}">
        <input type="email" name="email" placeholder="Email" value="{{ $student->email }}">
        <input type="text" name="address" placeholder="Address" value="{{ $student->address }}">
    </div>
</div>

<!-- ================= NEXT OF KIN ================= -->
<div class="form-section">
    <h3 class="section-title">Next of Kin</h3>

    <div class="grid">
        <input type="text" name="next_of_kin_name" placeholder="Full Name" value="{{ $student->next_of_kin_name }}">
        <input type="text" name="next_of_kin_phone" placeholder="Phone" value="{{ $student->next_of_kin_phone }}">
        <input type="text" name="next_of_kin_relationship" placeholder="Relationship" value="{{ $student->next_of_kin_relationship }}">
        <input type="text" name="next_of_kin_address" placeholder="Address" value="{{ $student->next_of_kin_address }}">
    </div>
</div>
<!-- ================= LOCATION ================= -->
<div class="form-section">
    <h3 class="section-title">Location Information</h3>

    <div class="grid">
        <!-- Origin Region -->
       <select name="origin_region" required>
        <option value="">Select Origin Region</option>
        @foreach($regions as $region)
            <option value="{{ $region->name }}">{{ $region->name }}</option>
        @endforeach
    </select>

         <!-- District -->
        <select name="origin_district" required value="{{ $student->origin_district }}">
            <option value="">Select District</option>
            @foreach($districts as $district)
                <option value="{{ $district->name }}">{{ $district->name }}</option>
            @endforeach
        </select>

        <!-- Entry Region (text input) -->
        <input type="text" name="entry_region" placeholder="Entry Region" value="{{ $student->entry_region }}">
    </div>
</div>

<!-- ================= PHOTO ================= -->
<div class="form-section">
    <h3 class="section-title">Student Photo</h3>

    <div class="grid">
        @if($student->photo)
        <img src="{{ asset('uploads/'.$student->photo) }}" width="80" style="border-radius:8px;">
        @endif
    </div>

</div>
<!-- SUBMIT -->
<div class="form-actions">
    <button type="submit" class="btn-primary">
        Save Student
    </button>
</div>

</form>

@endsection