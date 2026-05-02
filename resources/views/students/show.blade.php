@extends('layouts.admin')

@section('content')

<style>
/* MAIN CARD */
.profile-card{
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
    max-width:950px;
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

/* GRID */
.profile-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:15px;
}

@media(max-width:768px){
    .profile-grid{ grid-template-columns:1fr; }
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

/* STATUS */
.status{
    padding:4px 10px;
    border-radius:20px;
    font-size:12px;
}
.status.active{ background:#dcfce7; color:#166534; }
.status.inactive{ background:#fee2e2; color:#991b1b; }

/* COMMENT */
.comment{
    margin-top:20px;
    padding:15px;
    background:#f3f4f6;
    border-radius:8px;
}

/* DOCUMENT GRID */
.doc-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:15px;
    margin-top:15px;
}

@media(max-width:992px){
    .doc-grid{ grid-template-columns:repeat(2,1fr); }
}

@media(max-width:600px){
    .doc-grid{ grid-template-columns:1fr; }
}

.doc-card{
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:10px;
    padding:12px;
    box-shadow:0 2px 6px rgba(0,0,0,0.05);
    transition:.2s;
}

.doc-card:hover{
    transform:translateY(-3px);
}

.doc-btn{
    display:inline-block;
    margin-top:8px;
    background:#2563eb;
    color:#fff;
    padding:5px 10px;
    border-radius:6px;
    font-size:12px;
    text-decoration:none;
}
</style>

<div class="profile-card">

<!-- HEADER -->
<div class="profile-header">
    <img src="{{ $student->photo ? asset('storage/'.$student->photo) : asset('images/default-avatar.png') }}" class="profile-img">

    <div>
        <h3 style="margin:0;">
            {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
        </h3>

        <p><strong>Force No:</strong> {{ $student->force_number }}</p>
        <p><strong>NIDA:</strong> {{ $student->nida }}</p>
        <p><strong>Email:</strong> {{ $student->email }}</p>

        <span class="status {{ $student->status }}">
            {{ ucfirst($student->status) }}
        </span>
    </div>
</div>

<!-- DETAILS -->
<div class="profile-grid">

    <div>
        <h4>Phone</h4>
        <p>{{ $student->phone }}</p>
    </div>

    <div>
        <h4>Gender</h4>
        <p>{{ $student->gender }}</p>
    </div>

    <div>
        <h4>Date of Birth</h4>
        <p>{{ $student->date_of_birth }}</p>
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
        <h4>Origin District</h4>
        <p>{{ $student->origin_district }}</p>
    </div>

    <div>
        <h4>Entry Region</h4>
        <p>{{ $student->entry_region }}</p>
    </div>

    <div>
        <h4>Address</h4>
        <p>{{ $student->address }}</p>
    </div>

    <div>
        <h4>Next of Kin</h4>
        <p>{{ $student->next_of_kin_name }}</p>
    </div>

    <div>
        <h4>Next of Kin Phone</h4>
        <p>{{ $student->next_of_kin_phone }}</p>
    </div>

    <div>
        <h4>Relationship</h4>
        <p>{{ $student->next_of_kin_relationship }}</p>
    </div>

</div>

<!-- COMMENT -->
<div class="comment">
    <h4>Comment</h4>
    <p>{{ $student->comment ?? 'No comment available' }}</p>
</div>

<!-- DOCUMENTS -->
@if($documents->count())
<div class="comment">
    <h4>Student Documents</h4>

    <div class="doc-grid">
        @foreach($documents as $doc)
        <div class="doc-card">

            <strong>
                {{ ucfirst(str_replace('_',' ', $doc->type)) }}
            </strong>

            <p style="font-size:12px; color:#666;">
                {{ $doc->created_at->diffForHumans() }}
            </p>

            <a href="{{ asset('storage/'.$doc->file_path) }}" 
               target="_blank" 
               class="doc-btn">
               View
            </a>

        </div>
        @endforeach
    </div>

    <div style="margin-top:15px;">
        {{ $documents->links() }}
    </div>

</div>
@else
<div class="comment">
    <p style="color:#94a3b8;">No documents available</p>
</div>
@endif

</div>

@endsection