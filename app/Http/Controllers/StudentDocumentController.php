<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentDocument;
use Illuminate\Support\Facades\Storage;

class StudentDocumentController extends Controller
{
    // STORE DOCUMENT
    public function store(Request $request, $studentId)
    {
        $request->validate([
            'type' => 'required',
            'file' => 'required|file|mimes:pdf,jpg,png,docx',
        ]);

        $path = $request->file('file')->store('students/documents', 'public');

        StudentDocument::create([
            'student_id' => $studentId,
            'type' => $request->type,
            'title' => $request->title,
            'file_path' => $path,
            'remarks' => $request->remarks,
        ]);

        return back()->with('success', 'Document uploaded successfully');
    }

    // DELETE DOCUMENT
    public function destroy($id)
    {
        $doc = StudentDocument::findOrFail($id);

        Storage::disk('public')->delete($doc->file_path);

        $doc->delete();

        return back()->with('success', 'Document deleted');
    }

    // VIEW SINGLE FILE (optional route)
    public function view($id)
    {
        $doc = StudentDocument::findOrFail($id);

        return response()->file(storage_path("app/public/{$doc->file_path}"));
    }
}
