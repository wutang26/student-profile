<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Student;

class HighChartController extends Controller
{
      /**
     * DASHBOARD (CARDS + CHART DATA)
     */
    public function index()
    {
        // =========================
        // 1. TOTAL STUDENTS
        // =========================
        $totalStudents = Student::count();

        // =========================
        // 2. COMPANY COUNTS (REAL DB)
        // =========================
        $hq = Student::where('company', 'HQ-Coy')->count();
        $aCoy = Student::where('company', 'A-COY')->count();
        $bCoy = Student::where('company', 'B-COY')->count();
        $cCoy = Student::where('company', 'C-COY')->count();

        // =========================
        // 3. CHART DATA (same as cards but for Highcharts)
        // =========================
        $categories = ['HQ-Coy', 'A-COY', 'B-COY', 'C-COY'];

        $safari = [
            Student::where('company', 'HQ-Coy')->where('status', 'safari')->count(),
            Student::where('company', 'A-COY')->where('status', 'safari')->count(),
            Student::where('company', 'B-COY')->where('status', 'safari')->count(),
            Student::where('company', 'C-COY')->where('status', 'safari')->count(),
        ];

        $discipline = [
            Student::where('company', 'HQ-Coy')->where('status', 'discipline')->count(),
            Student::where('company', 'A-COY')->where('status', 'discipline')->count(),
            Student::where('company', 'B-COY')->where('status', 'discipline')->count(),
            Student::where('company', 'C-COY')->where('status', 'discipline')->count(),
        ];

        $sick = [
            Student::where('company', 'HQ-Coy')->where('status', 'sick')->count(),
            Student::where('company', 'A-COY')->where('status', 'sick')->count(),
            Student::where('company', 'B-COY')->where('status', 'sick')->count(),
            Student::where('company', 'C-COY')->where('status', 'sick')->count(),
        ];

        $warning = [
            Student::where('company', 'HQ-Coy')->where('status', 'warning')->count(),
            Student::where('company', 'A-COY')->where('status', 'warning')->count(),
            Student::where('company', 'B-COY')->where('status', 'warning')->count(),
            Student::where('company', 'C-COY')->where('status', 'warning')->count(),
        ];

        return view('statics.estimated_joined', compact(
            'totalStudents',
            'hq',
            'aCoy',
            'bCoy',
            'cCoy',
            'categories',
            'safari',
            'discipline',
            'sick',
            'warning'
        ));
    }

    /**
     * ANALYTICS PAGE
     */
    public function analytics()
    {
        $disciplinedCompany = Student::select('company', DB::raw('COUNT(*) as total'))
            ->where('status', 'active')
            ->groupBy('company')
            ->orderByDesc('total')
            ->first();

        $problematicPlatoon = Student::select('platoon', DB::raw('COUNT(*) as total'))
            ->where('status', 'inactive')
            ->groupBy('platoon')
            ->orderByDesc('total')
            ->first();

        $monthlyTrends = Student::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw("SUM(CASE WHEN status='active' THEN 1 ELSE 0 END) as good"),
                DB::raw("SUM(CASE WHEN status='inactive' THEN 1 ELSE 0 END) as bad")
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

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
