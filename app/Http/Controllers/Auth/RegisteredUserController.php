<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $profilePhotoPath = null;

    // Handle image upload
    if ($request->hasFile('profile_photo')) {
        $file = $request->file('profile_photo');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/profiles'), $filename);

        $profilePhotoPath = 'uploads/profiles/'.$filename;
    }

    // Create user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'profile_photo' => $profilePhotoPath, // ✅ FIXED HERE
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
}

    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //         'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //     ]);

    //      $profilePhotoPath = null;

    // // Handle image upload
    // if ($request->hasFile('profile_photo')) {
    //     $file = $request->file('profile_photo');
    //     $filename = time().'_'.$file->getClientOriginalName();
    //     $file->move(public_path('uploads/profiles'), $filename);

    //     $profilePhotoPath = 'uploads/profiles/'.$filename;
    // }

    // //Handle user creation
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'profile_photo' => $profilePhotoPath,
    //     ]);

       
    //     event(new Registered($user));

    //     Auth::login($user);

    //     return redirect(RouteServiceProvider::HOME);
    // }
}
