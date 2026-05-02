<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
Use App\Models\Region;
Use App\Models\District;

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
        $regions = Region::all();
        $districts = District::all();
        return view('students.create', compact('regions','districts'));
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
        'origin_region' => 'required',
        'origin_district' => 'required',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->all();

    // HANDLE PHOTO UPLOAD
    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('students', 'public');
    }

    Student::create($data);

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
   public function edit($id)
{
    $student = Student::findOrFail($id);

    $regions = Region::all();

    $districts = District::all();

    return view('students.edit', compact('student','regions','districts'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $student = Student::findOrFail($id);

    $request->validate([
        'first_name' => 'required',
        'force_number' => 'required|unique:students,force_number,' . $id,
        'nida' => 'required',
    ]);

    $data = $request->all();

    // Handle photo update
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $data['photo'] = $filename;
    }

    $student->update($data);

    return redirect()->route('students.index')->with('success', 'Student updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $student = Student::findOrFail($id);

    // delete photo if exists
    if ($student->photo && file_exists(public_path('uploads/'.$student->photo))) {
        unlink(public_path('uploads/'.$student->photo));
    }

    $student->delete();

    return redirect()->route('students.index')->with('success', 'Student deleted successfully');
}
}
