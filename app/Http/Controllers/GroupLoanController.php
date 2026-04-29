<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;

class GroupLoanController extends Controller
{
    

 public function create()
    {
        $groups = Group::all();
        return view('grouploans.create', compact('groups'));
    }

   public function store(Request $request)
{


    // 1. Validate request
    $request->validate([
        'group_id' => 'required|exists:groups,id',
        'total_amount' => 'required|numeric|min:1',
    ]);

    // 2. Get group with users
    $group = Group::with('users')->findOrFail($request->group_id);

    $memberCount = $group->users->count();

    // 3. Prevent crash if no members
    if ($memberCount == 0) {
        return back()->with('error', 'This group has no members.');
    }

    // 4. Create group loan
    $loan = GroupLoan::create([
        'group_id' => $group->id,
        'total_amount' => $request->total_amount,
    ]);

    // 5. Split loan per member
    $perMember = $loan->total_amount / $memberCount;

    // 6. Assign loan to each member
    foreach ($group->users as $user) {
        GroupLoanMember::create([
            'group_loan_id' => $loan->id,
            'user_id' => $user->id,
            'amount' => $perMember,
        ]);
    }

    return redirect()->back()->with('success', 'Group loan created successfully!');
}
}
