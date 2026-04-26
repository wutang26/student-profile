<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::latest()->get();

        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
     public function create()
    {
        $users = User::all();
        return view('groups.create', compact('users'));
    }

    public function store(Request $request)
    {
        $group = Group::create($request->only('name', 'description'));

        if ($request->users) {
            foreach ($request->users as $userId => $share) {
                $group->users()->attach($userId, [
                    'share_percentage' => $share
                ]);
            }
        }

        return redirect()->route('groups.index');
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
}
