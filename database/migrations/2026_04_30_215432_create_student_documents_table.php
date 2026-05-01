<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function index()
    {
        $documents = StudentDocument::with('student')->latest()->get();
        return view('students.documents.index', compact('documents'));
    }

    public function create()
    {
        $students = Student::all();
        return view('students.documents.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'type' => 'required|string',
            'title' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,jpg,png,doc,docx',
            'remarks' => 'nullable|string'
        ]);

        // upload file
        $path = $request->file('file')->store('student_documents', 'public');

        StudentDocument::create([
            'student_id' => $request->student_id,
            'type' => $request->type,
            'title' => $request->title,
            'file_path' => $path,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('students.documents.index')->with('success', 'Document uploaded successfully');
    }

    public function destroy($id)
    {
        $doc = StudentDocument::findOrFail($id);
        $doc->delete();

        return back()->with('success', 'Document deleted');
    }
};
