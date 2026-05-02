<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentDocument;
use Illuminate\Support\Facades\Storage;

class StudentDocumentController extends Controller
{
    // 📄 LIST ALL DOCUMENTS
    public function index(Request $request)
{
    $query = StudentDocument::with('student');

    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('title', 'like', "%$search%")
              ->orWhere('type', 'like', "%$search%")
              ->orWhere('remarks', 'like', "%$search%")

              // search inside student
              ->orWhereHas('student', function ($s) use ($search) {
                  $s->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('force_number', 'like', "%$search%");
              });

        });
    }

    $documents = $query->latest()->get();

    return view('students.documents.index', compact('documents'));
}

    // ➕ SHOW CREATE FORM
    public function create()
    {
        $students = Student::all();

        return view('students.documents.create', compact('students'));
    }

    // 💾 STORE DOCUMENT
  public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required|exists:students,id',
        'type' => 'required|string',
        'title' => 'nullable|string',
        'file' => 'required|file|mimes:pdf,jpg,png,doc,docx|max:2048',
        'remarks' => 'nullable|string'
    ]);

    // Upload file
    $path = $request->file('file')->store('student_documents', 'public');

    // Save to database
    StudentDocument::create([
        'student_id' => $request->student_id,
        'type' => $request->type,
        'title' => $request->title,
        'file_path' => $path,
        'remarks' => $request->remarks,
    ]);

    return redirect()
        ->route('students.documents.index')
        ->with('success', 'Document uploaded successfully');
}

    // 🗑 DELETE DOCUMENT
    public function destroy($id)
    {
        $doc = StudentDocument::findOrFail($id);

        // Delete file from storage
        if (Storage::disk('public')->exists($doc->file_path)) {
            Storage::disk('public')->delete($doc->file_path);
        }

        $doc->delete();

        return back()->with('success', 'Document deleted successfully');
    }


}
