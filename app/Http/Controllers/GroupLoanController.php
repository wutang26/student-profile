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
        $loan = GroupLoan::create($request->all());

        $group = Group::find($request->group_id);

        $perMember = $loan->total_amount / $group->users->count();

        foreach ($group->users as $user) {
            GroupLoanMember::create([
                'group_loan_id' => $loan->id,
                'user_id' => $user->id,
                'amount' => $perMember
            ]);
        }

        return redirect()->back();
    }
}
