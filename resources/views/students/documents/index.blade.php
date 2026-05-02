@extends('layouts.admin')

@section('content')

<style>
/* HEADER BAR */
.header-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:10px;
    margin-bottom:15px;
}

/* LEFT SIDE */
.header-left{
    display:flex;
    align-items:center;
    gap:10px;
}

/* RIGHT SIDE */
.header-right{
    display:flex;
    align-items:center;
    gap:8px;
}

/* SEARCH */
.search-box{
    padding:7px 10px;
    border:1px solid #cbd5e1;
    border-radius:6px;
    font-size:14px;
}

/* BUTTON */
.btn-primary{
    background:#3b82f6;
    color:#fff;
    padding:7px 12px;
    border-radius:6px;
    border:none;
    cursor:pointer;
    font-size:14px;
    display:flex;
    align-items:center;
    gap:5px;
}

.btn-primary:hover{
    background:#2563eb;
}

/* TABLE */
.table-container{
    background:#fff;
    border-radius:10px;
    padding:10px;
    box-shadow:0 2px 8px rgba(0,0,0,0.05);
}

.table{
    width:100%;
    border-collapse:collapse;
}

.table th{
    background:#f1f5f9;
    padding:10px;
    font-size:13px;
    text-align:left;
}

.table td{
    padding:10px;
    border-top:1px solid #e2e8f0;
}

.table tr:hover{
    background:#f9fafb;
}

/* ACTION BUTTON */
.btn-danger{
    background:#ef4444;
    color:#fff;
    padding:5px 10px;
    border:none;
    border-radius:6px;
    cursor:pointer;
}

.btn-danger:hover{
    background:#dc2626;
}

/* EMPTY */
.empty{
    text-align:center;
    padding:20px;
    color:#94a3b8;
}
/* DOCUMENT GRID */
.doc-grid{
    display:grid;
    grid-template-columns:repeat(4, 1fr);
    gap:15px;
    margin-top:15px;
}

@media(max-width:992px){
    .doc-grid{
        grid-template-columns:repeat(2, 1fr);
    }
}

@media(max-width:600px){
    .doc-grid{
        grid-template-columns:1fr;
    }
}

/* DOCUMENT CARD */
.doc-card{
    background:#ffffff;
    border:1px solid #e5e7eb;
    border-radius:10px;
    padding:12px;
    box-shadow:0 2px 6px rgba(0,0,0,0.05);
    transition:0.2s;
}

.doc-card:hover{
    transform:translateY(-3px);
}

/* BUTTON */
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

<!-- HEADER -->
<div class="header-bar">

    <!-- LEFT: TITLE + UPLOAD -->
    <div class="header-left">
        <h2 class="page-title" style="margin:0;">
            <i class="bi bi-folder2-open"></i> Student Documents
        </h2>

        @can('view students')
        <a href="{{ route('students.documents.create') }}" class="btn-primary">
            <i class="bi bi-cloud-arrow-up"></i> Upload
        </a>
        @endcan
    </div>

    <!-- RIGHT: SEARCH -->
    <div class="header-right">
        <form method="GET" action="{{ route('students.documents.index') }}" style="display:flex; gap:6px;">
            
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Search document..."
                class="search-box"
            >

            <button type="submit" class="btn-primary">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

</div>

<!-- SEARCH RESULT INFO -->
@if(request('search'))
    <p style="margin-bottom:10px; color:#64748b;">
        Results for: <strong>{{ request('search') }}</strong>
    </p>
@endif

<!-- TABLE -->
<div class="table-container">
<table class="table">
    <thead>
        <tr>
            <th>Force Number</th>
            <th>Student</th>
            <th>Type</th>
            <th>Title</th>
            <th>View</th>
            <th>Comments</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @forelse($documents as $doc)
        <tr>
            <td>K.{{ $doc->student->force_number ?? '-' }}</td>
            <td>{{ $doc->student->first_name ?? '-' }}</td>
            <td>{{ ucfirst($doc->type) }}</td>
            <td>{{ $doc->title }}</td>

            <td>
                <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>

            <td>{{ $doc->remarks }}</td>

            @can('view students')
            <td>
                <form method="POST" action="{{ route('students.documents.destroy', $doc->id) }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-danger"
                        onclick="return confirm('Delete this document?')">
                        Delete
                    </button>
                </form>
            </td>
            @endcan
        </tr>
        @empty
        <tr>
            <td colspan="7" class="empty">No documents found</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

@endsection