@extends('layouts.admin')

@section('content')

<h1 class="page-title">Register Student</h1>

<form method="POST" action="{{ route('students.store') }}" class="form-box">
@csrf

<!-- BASIC INFO -->
<div class="grid">

    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="middle_name" placeholder="Middle Name">
    <input type="text" name="last_name" placeholder="Last Name">

    <input type="text" name="force_number" placeholder="Force Number" required>
    <input type="text" name="nida" placeholder="NIDA" required>

    <input type="date" name="date_of_birth">

    <select name="gender">
        <option value="">Gender</option>
        <option>Male</option>
        <option>Female</option>
    </select>

</div>

<!-- COMPANY / PLATOON -->
<div class="grid">

    <select name="company" required>
        <option value="">Select Company</option>
        <option>HQ-Coy</option>
        <option>A-Coy</option>
        <option>B-Coy</option>
        <option>C-Coy</option>
        <option>D-Coy</option>
    </select>

    <select name="platoon" required>
        <option value="">Select Platoon</option>
        @for($i = 1; $i <= 18; $i++)
            <option value="Platoon {{ $i }}">Platoon {{ $i }}</option>
        @endfor
    </select>

</div>

<!-- CONTACT -->
<div class="grid">

    <input type="text" name="phone" placeholder="Phone">
    <input type="email" name="email" placeholder="Email">
    <input type="text" name="address" placeholder="Address">

</div>

<!-- NEXT OF KIN -->
<div class="grid">

    <input type="text" name="next_of_kin_name" placeholder="Next of Kin Name">
    <input type="text" name="next_of_kin_phone" placeholder="Next of Kin Phone">
    <input type="text" name="next_of_kin_relationship" placeholder="Relationship">
    <input type="text" name="next_of_kin_address" placeholder="Address">

</div>

<button type="submit" class="btn-primary">Save Student</button>

</form>

@endsection