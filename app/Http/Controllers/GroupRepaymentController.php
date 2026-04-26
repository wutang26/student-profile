<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupRepaymentController extends Controller
{
    //
     public function store(Request $request)
    {
        GroupLoanRepayment::create($request->all());

        return back();
    }
}
