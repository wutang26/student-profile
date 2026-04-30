<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = Student::latest()->paginate(10);
        
         $query = Student::query();

    if ($request->search) {
        $query->where('first_name', 'like', '%' . $request->search . '%')
              ->orWhere('last_name', 'like', '%' . $request->search . '%')
              ->orWhere('force_number', 'like', '%' . $request->search . '%')
              ->orWhere('nida', 'like', '%' . $request->search . '%');
    }

    $students = $query->get();

    // cards data
    $totalStudents = Student::count();

    $companyCounts = [
        'HQ-Coy' => Student::where('company', 'HQ-Coy')->count(),
        'A-Coy' => Student::where('company', 'A-Coy')->count(),
        'B-Coy' => Student::where('company', 'B-Coy')->count(),
        'C-Coy' => Student::where('company', 'C-Coy')->count(),
        'D-Coy' => Student::where('company', 'D-Coy')->count(),
    ];

    $totalPlatoons = Student::distinct('platoon')->count('platoon');

    return view('students.index', compact(
        'students',
        'totalStudents',
        'companyCounts',
        'totalPlatoons'
    ));
     
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
     public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'force_number' => 'required|unique:students',
            'nida' => 'required|unique:students',
            'company' => 'required',
            'platoon' => 'required',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
