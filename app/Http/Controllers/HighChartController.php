<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class HighChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
         
             //Egar load a relation ship controller for member and districts and region
        // $members = Member::with(['region', 'district'])->get();
    

        // return view('statics.estimated_joined', compact('members'));

         $members = Member::with(['region', 'district'])->get();

        $categories = ['Temeke', 'Mufindi', 'Mvomero', 'Lindi', 'Nyegezi', 'Nzega'];

        $regionData = [387749, 280000, 129000, 64300, 54000, 34300];
        $districtData = [45321, 140000, 10000, 140500, 19500, 113500];

        return view('statics.estimated_joined', compact(
            'categories',
            'regionData',
            'districtData'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

public function analytics()
{
    // 1. Most disciplined company
    $disciplinedCompany = Student::select('company', DB::raw('COUNT(*) as total'))
        ->where('status', 'active')
        ->groupBy('company')
        ->orderByDesc('total')
        ->first();

    // 2. Most problematic platoon
    $problematicPlatoon = Student::select('platoon', DB::raw('COUNT(*) as total'))
        ->where('status', 'inactive')
        ->groupBy('platoon')
        ->orderByDesc('total')
        ->first();

    // 3. Monthly behavior trends
    $monthlyTrends = Student::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw("SUM(CASE WHEN status='active' THEN 1 ELSE 0 END) as good"),
            DB::raw("SUM(CASE WHEN status='inactive' THEN 1 ELSE 0 END) as bad")
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // 4. Attendance vs discipline (example logic)
    $attendanceDiscipline = Student::select(
            DB::raw("SUM(CASE WHEN attendance_status='present' THEN 1 ELSE 0 END) as present"),
            DB::raw("SUM(CASE WHEN attendance_status='absent' THEN 1 ELSE 0 END) as absent"),
            DB::raw("SUM(CASE WHEN status='inactive' THEN 1 ELSE 0 END) as disciplined")
        )
        ->first();

    return view('analytics.dashboard', compact(
        'disciplinedCompany',
        'problematicPlatoon',
        'monthlyTrends',
        'attendanceDiscipline'
    ));
}
}
