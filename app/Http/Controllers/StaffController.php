<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{

  //List Staff Resource
 public function index(){
      
   $staffs = Staff::all();

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
}
