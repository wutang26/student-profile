<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentDocument;

class DashboardController extends Controller
{
   public function index()
{
    // TOTAL STUDENTS (optional)
    $totalStudents = \App\Models\Student::count();

    // COMPANY COUNTS
    $hq = \App\Models\Student::where('company','HQ-Coy')->count();
    $aCoy = \App\Models\Student::where('company','A-COY')->count();
    $bCoy = \App\Models\Student::where('company','B-COY')->count();
    $cCoy = \App\Models\Student::where('company','C-COY')->count();

    // =========================
    // DOCUMENT TYPES (REAL DATA)
    // =========================
    $warning = StudentDocument::where('type', 'warning')->count();
    $transfer = StudentDocument::where('type', 'transfer')->count();
    $medical = StudentDocument::where('type', 'medical')->count();
    $discipline = StudentDocument::where('type', 'discipline')->count();
    $safari = StudentDocument::where('type', 'safari')->count();
    $description_letter = StudentDocument::where('type', 'description_letter')->count();

    // chart categories
    $categories = [
        'Warning',
        'Transfer',
        'Medical',
        'Discipline',
        'Safari',
        'Letter'
    ];

    $chartData = [
        $warning,
        $transfer,
        $medical,
        $discipline,
        $safari,
        $description_letter
    ];

    return view('dashboard', compact(
        'totalStudents',
        'hq','aCoy','bCoy','cCoy',
        'categories',
        'chartData'
    ));
}
}