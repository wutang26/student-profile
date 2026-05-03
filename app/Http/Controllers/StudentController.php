<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
Use App\Models\Region;
Use App\Models\District;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

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
     $documents = $student->documents()
        ->latest()
        ->paginate(8); // 4 per row → 2 rows per page

    return view('students.show', compact('student', 'documents'));
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

//Excel Uploading 
public function import(Request $request)
{

    $request->validate([
        'file' => 'required|mimes:csv,xlsx,txt'
    ]);

   $file = fopen($request->file('file')->getRealPath(), 'r');

    $header = fgetcsv($file); // skip header

    while ($row = fgetcsv($file)) {
            if (count($row) < 18) {
                continue; // skip broken rows
            }

            Student::create([
                'first_name' => $row[0] ?? null,
                'middle_name' => $row[1] ?? null,
                'last_name' => $row[2] ?? null,
                'force_number' => $row[3] ?? null,
                'nida' => $row[4] ?? null,
                'date_of_birth' => $row[5] ?? null,
                'gender' => $row[6] ?? null,
                'company' => $row[7] ?? null,
                'platoon' => $row[8] ?? null,
                'phone' => $row[9] ?? null,
                'email' => $row[10] ?? null,
                'address' => $row[11] ?? null,
                'next_of_kin_name' => $row[12] ?? null,
                'next_of_kin_phone' => $row[13] ?? null,
                'next_of_kin_relationship' => $row[14] ?? null,
                'next_of_kin_address' => $row[15] ?? null,
                'origin_region' => $row[16] ?? null,
                'origin_district' => $row[17] ?? null,
                'entry_region' => $row[18] ?? null,
            ]);
}

    fclose($file);

    return back()->with('success', 'Students imported via CSV!');
}

}
