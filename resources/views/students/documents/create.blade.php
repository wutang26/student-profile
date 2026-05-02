@extends('layouts.admin')

@section('content')

<style>
/* HEADER */
.page-title {
    font-size: 24px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 20px;
}

/* FORM CARD */
.form-box {
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

/* GRID */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 18px;
}

/* FORM GROUP */
.form-group {
    display: flex;
    flex-direction: column;
}

/* LABELS */
.form-group label {
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #334155;
}

/* INPUTS */
.form-group input,
.form-group select,
textarea {
    padding: 10px 12px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 14px;
    background: #f8fafc;
    transition: 0.2s;
}

/* FOCUS EFFECT */
.form-group input:focus,
.form-group select:focus,
textarea:focus {
    border-color: #3b82f6;
    background: #ffffff;
    outline: none;
    box-shadow: 0 0 0 2px rgba(59,130,246,0.1);
}

/* TEXTAREA */
textarea {
    width: 100%;
    margin-top: 18px;
}

/* BUTTON */
.btn-primary {
    margin-top: 22px;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    padding: 11px 20px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 14px rgba(37,99,235,0.25);
}
</style>

<h2 class="page-title">📄 Upload Student Document</h2>

<form action="{{ route('students.documents.store') }}" method="POST" enctype="multipart/form-data" class="form-box">
@csrf

<div class="grid">

    <!-- Student -->
    <div class="form-group">
        <label>Select Student</label>
        <select name="student_id" required>
            <option value="">Select Student</option>
            @foreach($students as $student)
                <option value="{{ $student->id }}">
                    {{ $student->first_name }} {{ $student->last_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Type -->
    <div class="form-group">
        <label>Document Type</label>
        <select name="type" required>
            <option value="">Select Type</option>
            <option value="warning">⚠ Warning</option>
            <option value="transfer">🔄 Transfer</option>
            <option value="medical">🏥 Medical</option>
            <option value="discipline">📋 Discipline</option>
            <option value="safari">🚌 Safari</option>
            <option value="description_letter">📝 Description Letter</option>
        </select>
    </div>

    <!-- Title -->
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" placeholder="Document Title (optional)">
    </div>

    <!-- File -->
    <div class="form-group">
        <label>Upload File</label>
        <input type="file" name="file" required>
    </div>

</div> <br>

<!-- Remarks -->
<div class="form-group">
    <label>Remarks or Comment</label>
    <textarea name="remarks" rows="4" placeholder="Remarks (optional)"></textarea>
</div>

<button type="submit" class="btn-primary">
    ⬆ Upload Document
</button>

</form>

@endsection