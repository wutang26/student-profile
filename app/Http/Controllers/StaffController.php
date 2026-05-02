<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;


class StaffController extends Controller
{

  //List Staff Resource
//  public function index(){
      

//    $staffs = Staff::all();

//     return view('staff.index', compact('staffs'));
//     }
public function index(Request $request)
{
    $query = Staff::query();

    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%$search%")
              ->orWhere('last_name', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%")
              ->orWhere('force_number', 'like', "%$search%")
              ->orWhere('rank', 'like', "%$search%")
              ->orWhere('department', 'like', "%$search%");
        });
    }

    $staffs = $query->latest()->get();

    return view('staff.index', compact('staffs'));
}

    //Register A staff Member
   public function create()
    {
        $staffs = Staff::all();
     
        return view('staff.create', compact('staffs'));
    }

//Store Staff Resources
   public function store(Request $request)
{

  $request->validate([
    'first_name' => 'required',
    'last_name' => 'required',
    'force_number' => 'required|unique:staffs,force_number',
    'email' => 'required|email|unique:staffs,email',
    'role' => 'required',
    'password' => 'required|min:6',
]);

    Staff::create([
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
        'force_number' => $request->force_number,
        'rank' => $request->rank,
        'department' => $request->department,
        'phone' => $request->phone,
        'email' => $request->email,
        'role' => $request->role,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('staff.index')->with('success', 'Staff registered successfully');
}

//Show Function 
public function show($id)
{
    $staff = Staff::findOrFail($id);
    return view('staff.show', compact('staff'));
}

//Edit function
public function edit($id)
{
    $staff = Staff::findOrFail($id);
    return view('staff.edit', compact('staff'));
}

//Update

public function update(Request $request, $id)
{
    $staff = Staff::findOrFail($id);

    $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'force_number' => 'required|unique:staffs,force_number,' . $id,
        'email' => 'required|email|unique:staffs,email,' . $id,
        'role' => 'required',
    ]);

    $staff->update([
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
        'force_number' => $request->force_number,
        'rank' => $request->rank,
        'department' => $request->department,
        'phone' => $request->phone,
        'email' => $request->email,
        'role' => $request->role,

        // only update password if filled
        'password' => $request->password 
            ? Hash::make($request->password) 
            : $staff->password,
    ]);

    return redirect()->route('staff.index')->with('success', 'Staff updated successfully');
}


//Delete Function
public function destroy($id)
{
    $staff = Staff::findOrFail($id);
    $staff->delete();

    return redirect()->route('staff.index')->with('success', 'Staff deleted successfully');
}


}
