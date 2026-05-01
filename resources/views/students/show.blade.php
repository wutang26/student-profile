@extends('layouts.admin')

@section('content')

<style>
    /* MAIN CARD */
    .profile-card{
        background:#fff;
        padding:20px;
        border-radius:12px;
        box-shadow:0 2px 10px rgba(0,0,0,0.08);
        max-width:900px;
        margin:auto;
    }

    /* HEADER */
    .profile-header{
        display:flex;
        align-items:center;
        gap:20px;
        border-bottom:1px solid #eee;
        padding-bottom:15px;
        margin-bottom:20px;
    }

    .profile-img{
        width:110px;
        height:110px;
        border-radius:50%;
        object-fit:cover;
        border:3px solid #e5e7eb;
    }

    .profile-header h1{
        margin:0;
        font-size:22px;
    }

    .profile-header p{
        margin:3px 0;
        color:#666;
    }

    /* STATUS */
    .status{
        display:inline-block;
        padding:4px 10px;
        border-radius:20px;
        font-size:12px;
        margin-top:5px;
    }

    .status.active{
        background:#dcfce7;
        color:#166534;
    }

    .status.inactive{
        background:#fee2e2;
        color:#991b1b;
    }

    /* GRID */
    .profile-grid{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:15px;
    }

    @media(max-width:768px){
        .profile-grid{
            grid-template-columns:1fr;
        }
    }

    .profile-grid div{
        background:#f9fafb;
        padding:12px;
        border-radius:8px;
    }

    .profile-grid h4{
        margin:0;
        font-size:13px;
        color:#666;
    }

    .profile-grid p{
        margin:5px 0 0;
        font-weight:500;
    }

    /* COMMENT */
    .comment{
        margin-top:20px;
        padding:15px;
        background:#f3f4f6;
        border-radius:8px;
    }

    .comment h4{
        margin:0 0 5px;
    }
</style>

<div class="profile-card">

    <!-- HEADER -->
    <div class="profile-header">

   <img 
    src="{{ $student->photo ? asset('storage/'.$student->photo) : asset('images/default-avatar.png') }}" 
    class="profile-img">

        <div>
         <p>
    <strong>Full Name:</strong>
    {{ $student->first_name }} {{ $student->last_name }}
</p>
            <p><strong>Force No:</strong> {{ $student->force_number }}</p>
            <p><strong>NIDA:</strong> {{ $student->nida }}</p>

            <span class="status {{ $student->status }}">
                {{ $student->status }}
            </span>
        </div>

    </div>

    <!-- DETAILS GRID -->
    <div class="profile-grid">

        <div>
            <h4>Phone</h4>
            <p>{{ $student->phone }}</p>
        </div>

        <div>
            <h4>Next of Kin</h4>
            <p>{{ $student->next_of_kin_name }}</p>
        </div>

        <div>
            <h4>Company</h4>
            <p>{{ $student->company }}</p>
        </div>

        <div>
            <h4>Platoon</h4>
            <p>{{ $student->platoon }}</p>
        </div>

        <div>
            <h4>Origin Region</h4>
            <p>{{ $student->origin_region }}</p>
        </div>

        <div>
            <h4>Entry Region</h4>
            <p>{{ $student->entry_region }}</p>
        </div>

            <div>
            <h4>Behaviour Trend</h4>
            <p>Good or Bad it Depend</p>
        </div>
        
           <div>
            <h4>Next Of Kin Phone</h4>
            <p>{{ $student->next_of_kin_phone }}</p>
        </div>
    </div>

    <!-- COMMENT -->
    <div class="comment">
        <h4>Comment</h4>
        <p>{{ $student->comment ?? 'No comment available' }}</p>
    </div>
     
    <!-- DESCRIPTION LETTER -->
<!-- DOCUMENTS -->
@if($student->documents->count())

<div class="comment">

    <h4>Student Documents</h4>

    @foreach($student->documents as $doc)

        <div style="margin-bottom:10px; padding:10px; border:1px solid #eee; border-radius:8px;">

            <strong>
                {{ ucfirst(str_replace('_',' ', $doc->type)) }}
            </strong>

            <br>

            <small>{{ $doc->created_at->diffForHumans() }}</small>

            <br><br>

            @if($student->documents->count())

<div class="comment">

    <h4>Student Documents</h4>

    @foreach($student->documents as $doc)

        <div style="margin-top:10px;">

            <p style="margin:0; font-weight:600;">
                {{ ucfirst(str_replace('_',' ', $doc->type)) }}
            </p>

            <p style="margin:2px 0; font-size:12px; color:#666;">
                {{ $doc->created_at->diffForHumans() }}
            </p>

            <a href="{{ asset('storage/'.$doc->file_path) }}"
               target="_blank"
               style="
                    display:inline-block;
                    margin-top:5px;
                    background:#2563eb;
                    color:#fff;
                    padding:5px 10px;
                    border-radius:5px;
                    text-decoration:none;
                    font-size:12px;
               ">
                View Document
            </a>

        </div>

        <hr style="margin:10px 0; border:none; border-top:1px solid #e5e7eb;">

    @endforeach

</div>

@endif

        </div>

    @endforeach

</div>

@endif
</div>

@endsection