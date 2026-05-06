<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditLog;

class AuditLogController extends Controller
{
    //
    public function index()
    { 
        // $logs = AuditLog::with('user')->latest()->paginate(20);

//     AuditLog::create([
//             'performed_by' => 1, // make sure user with ID 1 exists
//             'action' => 'test_action',
//             'target_type' => 'User',
//             'target_id' => 1,
//             'description' => 'Testing audit log'
// ]);

    // Fetch logs correctly
    $logs = AuditLog::with('user')->latest()->paginate(15);

        return view('admin.audit.index', compact('logs'));
    }


    
}
