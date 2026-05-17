@extends('layouts.admin')

@section('content')

<style>
    .btn-primary{
        background:#6B8F99;;
        color:#fff;
        padding:7px 12px;
        border-radius:6px;
        text-decoration:none;
        border:none;
        cursor:pointer;
        font-size:14px;
    }

    .btn-primary:hover{
        background:#1d4ed8;
    }

    .table-container{
        background:#fff;
        padding:10px;
        border-radius:10px;
        box-shadow:0 2px 8px rgba(0,0,0,0.08);
        overflow-x:auto;
    }

    .table{
        width:100%;
        border-collapse:collapse;
        font-size:14px;
    }

    .table th, .table td{
        padding:10px;
        border-bottom:1px solid #eee;
        text-align:left;
        white-space:nowrap;
    }

    .table tr:hover{
        background:#f9fafb;
    }

    .alert-success{
        background:#d1fae5;
        color:#065f46;
        padding:10px;
        border-radius:6px;
        margin-bottom:10px;
    }

    .status{
        padding:3px 8px;
        border-radius:20px;
        font-size:12px;
    }

    .status.active{
        background:#dcfce7;
        color:#166534;
    }

    .status.inactive{
        background:#fee2e2;
        color:#991b1b;
    }

    .status.dismissed{
    background:#7f1d1d;   /* dark red */
    color:#ffffff;        /* white text */
    font-weight:600;
}

    .action-btns{
        display:flex;
        gap:5px;
    }

    .btn-view{
        background:#0ea5e9;
        color:#fff;
        padding:5px 10px;
        border-radius:6px;
        text-decoration:none;
        font-size:12px;
    }

    .btn-view:hover{
        background:#0284c7;
    }

    .upload-box{
        background:#fff;
        padding:10px;
        border-radius:10px;
        margin-top:10px;
        box-shadow:0 2px 8px rgba(0,0,0,0.08);
    }

    .dismiss-btn{
    background:#dc2626;
    color:white;
    border:none;
    padding:6px 12px;
    border-radius:8px;
    cursor:pointer;
    font-size:13px;
    transition:0.3s;
}

.dismiss-btn:hover{
    background:#b91c1c;
}

/* MODAL BACKDROP */
.custom-modal{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.55);
    z-index:9999;
    justify-content:center;
    align-items:center;
    padding:15px;
}

/* MODAL BOX */
.custom-modal-content{
    background:white;
    width:100%;
    max-width:450px;
    border-radius:16px;
    overflow:hidden;
    animation:popup 0.25s ease;
    box-shadow:0 15px 40px rgba(0,0,0,0.25);
}

/* ANIMATION */
@keyframes popup{
    from{
        opacity:0;
        transform:scale(0.9);
    }
    to{
        opacity:1;
        transform:scale(1);
    }
}

/* HEADER */
.custom-modal-header{
    background:#7f1d1d;
    color:white;
    padding:16px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.custom-modal-header h3{
    margin:0;
    font-size:18px;
}

/* BODY */
.custom-modal-body{
    padding:20px;
}

/* TEXTAREA */
.custom-modal-body textarea{
    width:100%;
    min-height:100px;
    border:1px solid #ddd;
    border-radius:10px;
    padding:10px;
    resize:none;
    font-size:14px;
    margin-top:8px;
}

/* FOOTER */
.custom-modal-footer{
    display:flex;
    justify-content:flex-end;
    gap:10px;
    padding:15px 20px;
    border-top:1px solid #eee;
}

/* BUTTONS */
.modal-cancel{
    background:#e5e7eb;
    border:none;
    padding:8px 14px;
    border-radius:8px;
    cursor:pointer;
}

.modal-confirm{
    background:#dc2626;
    color:white;
    border:none;
    padding:8px 14px;
    border-radius:8px;
    cursor:pointer;
}

.close-modal{
    background:none;
    border:none;
    color:white;
    font-size:20px;
    cursor:pointer;
}
</style>
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
    
    <h1 class="page-title" style="margin:0;">Students List</h1>

    <!-- Search Form (Top Right) -->
    <form method="GET" action="{{ route('students.index') }}" style="display:flex; gap:5px;">
        <input 
            type="text" 
            name="search" 
            placeholder="Search student..." 
            value="{{ request('search') }}"
            style="padding:6px 10px; border:1px solid #ccc; border-radius:5px;"
        >

        <button type="submit" class="btn-primary">
            Search
        </button>
    </form>

    <div style="text-align:center; margin-bottom:15px;">

   <form method="POST" action="{{ route('set.intake') }}">
    @csrf

    @php
        $activeIntake = session('intake', '2025/2026');
        $activeCourse = session('course_id');

        $courses = \App\Models\Course::where('intake', $activeIntake)->get();
    @endphp

    <!-- Intake Dropdown -->
    <select name="intake"
            onchange="this.form.submit()"
            style="padding:6px 12px; border-radius:6px; border:1px solid #ccc;">

        @for($year = 2025; $year <= 2035; $year++)

            @php
                $value = $year . '/' . ($year + 1);
            @endphp

            <option value="{{ $value }}"
                {{ $activeIntake == $value ? 'selected' : '' }}>
                {{ $value }}
            </option>

        @endfor

    </select>

    <!-- Course Dropdown -->
    <select name="course_id"
            onchange="this.form.submit()"
            style="padding:6px 12px; border-radius:6px; border:1px solid #ccc; margin-left:8px;">

        <option value="">-- Select Course --</option>

        @foreach($courses as $course)

            <option value="{{ $course->id }}"
                {{ $activeCourse == $course->id ? 'selected' : '' }}>

                {{ $course->name }}

            </option>

        @endforeach

    </select>

</form>

    <!-----Coarse Registrations---->
 @php

    $activeIntake = session('intake', '2025/2026');

    $course = \App\Models\Course::find(session('course_id'));

    // OLD:
    // $course = \App\Models\Course::where('intake', $activeIntake)->get();

@endphp


    <!-- Active Badge -->
<div style="margin-top:5px; display:flex; gap:8px; justify-content:center; flex-wrap:wrap;">

    <!-- Intake -->
    <span style="
        background:#2563eb;
        color:white;
        padding:4px 12px;
        border-radius:20px;
        font-size:12px;
        font-weight:600;
    ">
        Intake: {{ $activeIntake }}
    </span>

    <!-- Course -->
    <span style="
        background:#059669;
        color:white;
        padding:4px 12px;
        border-radius:20px;
        font-size:12px;
        font-weight:600;
    ">
        <!--Course:--->
        {{ $course ? $course->name : 'No Course Assigned' }}
    </span>

</div>

</div>

</div>

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

@can('view students')
<a href="{{ route('students.create') }}" class="btn-primary">
    <i class="bi bi-person"></i> Register Student
</a>  
@endcan

<div class="upload-box" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;">

    <!-- LEFT: UPLOAD FORM -->
     
@can('view students')
    <form method="POST" action="{{ route('students.import') }}" enctype="multipart/form-data"
          style="display:flex; align-items:center; gap:10px;">
        @csrf

        <label style="font-weight:600;">Upload Excel File:</label>

        <input type="file" name="file" required>

        <button type="submit" class="btn-primary">
            Upload Students
        </button>
    </form>
@endcan

    <!-- RIGHT: TOTAL COUNT -->
     @can('view students')
     <!-- SAMPLE CSV DOWNLOAD -->
    <a href="{{ asset('assets/students_sample.csv') }}" 
       download
       class="btn-primary"
       style="text-decoration:none;">
        Download Sample CSV
    </a>
    @endcan
    
    @php
    $course = \App\Models\Course::find(session('course_id'));
@endphp

<div style="
    display:flex;
    align-items:center;
    gap:6px;
    background:#f3f4f6;
    padding:6px 12px;
    border-radius:20px;
    font-weight:600;
    white-space:nowrap;
">
    Total:

    <span style="
        background:#2563eb;
        color:#fff;
        padding:2px 10px;
        border-radius:20px;
        font-size:12px;
    ">

        @if($course)
            {{-- Course selected → filtered count --}}
            {{ $totalStudentsFiltered }}
        @else
            {{-- No course selected → ALL students --}}
            {{ $totalStudentsAllIntakes }}
        @endif

    </span>
</div>

</div>
<br>

<div class="table-container">
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Force No</th>
            <th>Name</th>
            <th>NIDA</th>
            <th>Company</th>
            <th>Platoon</th>
            <th>Phone</th>
            <th>Status</th>
             <th>More Details</th>
        </tr>
    </thead>

    <tbody>
        @foreach($students as $key => $student)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $student->force_number }}</td>
            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
            <td>{{ $student->nida }}</td>
            <td>{{ $student->company }}</td>
            <td>{{ $student->platoon }}</td>
            <td>{{ $student->phone }}</td>
            <td>
                <span class="status {{ $student->status }}">
                    {{ $student->status }}
                </span>
            </td>
        <td>
<div class="action-btns">

    <!-- VIEW -->
    <a href="{{ route('students.show', $student->id) }}" class="btn-view">
        View
    </a>

    @can('view students')
    <!-- EDIT -->
    <a href="{{ route('students.edit', $student->id) }}"
        class="btn-view"
        style="background:#f59e0b;">
        Edit
    </a>
    @endcan

    @can('view students')

    <!-- DISMISS BUTTON -->
   <button type="button"
        class="dismiss-btn"
        onclick="openDismissModal('{{ $student->id }}')">
    Dismiss
</button>

    @endcan

</div>


</td>
        </tr>
<!-- CUSTOM MODAL -->
<div class="custom-modal" id="dismissModal{{ $student->id }}">

    <div class="custom-modal-content">

        <!-- HEADER -->
        <div class="custom-modal-header">
            <h3>Dismiss Student</h3>

            <button type="button"
                    class="close-modal"
                    onclick="closeDismissModal('{{ $student->id }}')">
                &times;
            </button>
        </div>

        <!-- FORM -->
        <form action="{{ route('students.dismiss', $student->id) }}"
              method="POST">

            @csrf
            @method('PATCH')

            <!-- BODY -->
            <div class="custom-modal-body">

                <p>
                    You are dismissing:
                    <strong>
                        {{ $student->first_name }}
                        {{ $student->last_name }}
                    </strong>
                </p> <br>

                <label>
                    Reason for dismissal
                </label>

                <textarea name="reason" required placeholder="Utovu wa Nidhamu"></textarea>

            </div>

            <!-- FOOTER -->
            <div class="custom-modal-footer">

                <button type="button"
                        class="modal-cancel"
                        onclick="closeDismissModal('{{ $student->id }}')">

                    Cancel
                </button>

                <button type="submit"
                        class="modal-confirm">

                    Confirm Dismiss
                </button>

            </div>

        </form>

    </div>

</div>

        @endforeach
    </tbody>
</table>
</div>

<script>

function openDismissModal(id) {
    document.getElementById('dismissModal' + id).style.display = 'flex';
}

function closeDismissModal(id) {
    document.getElementById('dismissModal' + id).style.display = 'none';
}

/* CLOSE WHEN CLICKING OUTSIDE */
window.onclick = function(event) {

    document.querySelectorAll('.custom-modal').forEach(modal => {

        if (event.target === modal) {
            modal.style.display = 'none';
        }

    });

}

</script>

@endsection