<style>
.doc-card{
    background:#fff;
    padding:15px;
    border-radius:10px;
    box-shadow:0 2px 8px rgba(0,0,0,0.08);
    margin-top:20px;
}

.doc-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:10px;
}

.doc-item{
    border:1px solid #eee;
    padding:10px;
    border-radius:8px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.btn-small{
    background:#2563eb;
    color:#fff;
    padding:5px 8px;
    border-radius:5px;
    text-decoration:none;
    font-size:12px;
}

.btn-delete{
    background:#ef4444;
    color:#fff;
    padding:5px 8px;
    border-radius:5px;
    border:none;
    font-size:12px;
    cursor:pointer;
}
</style>

<div class="doc-card">

    <h3>Student Documents</h3>

    <!-- UPLOAD FORM -->
    <form method="POST" action="{{ route('students.documents.store', $student->id) }}" enctype="multipart/form-data">
        @csrf

        <div class="doc-grid">

            <select name="type" required>
                <option value="">Select Type</option>
                <option value="warning">Warning Letter</option>
                <option value="transfer">Transfer Letter</option>
                <option value="medical">Medical Letter</option>
                <option value="discipline">Discipline Letter</option>
                <option value="description_letter">Barua ya Maelezo</option>
            </select>

            <input type="file" name="file" required>

        </div>

        <br>

        <button class="btn-small">Upload Document</button>
    </form>

    <hr style="margin:15px 0;">

    <!-- LIST DOCUMENTS -->
    @foreach($student->documents as $doc)

        <div class="doc-item">

            <div>
                <strong>{{ ucfirst(str_replace('_',' ', $doc->type)) }}</strong>
                <br>
                <small>{{ $doc->created_at->diffForHumans() }}</small>
            </div>

            <div style="display:flex; gap:5px;">

                <a href="{{ asset('storage/'.$doc->file_path) }}"
                   target="_blank"
                   class="btn-small">
                    View
                </a>

                <form method="POST"
                      action="{{ route('students.documents.delete', $doc->id) }}">
                    @csrf
                    @method('DELETE')

                    <button class="btn-delete">
                        Delete
                    </button>
                </form>

            </div>

        </div>

    @endforeach

</div>