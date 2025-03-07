<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function profile()
    {
        return view('profile.edit');
    }

    public function profileUpdate()
    {
        //Update Profile by User
        $user = User::find(auth()->user()->id);
        $user->name = request('name');
        $user->email = request('email');
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');

    }

    public function password()
    {
        return view('profile.edit');
    }

    public function passwordUpdate()
    {
        //Update Password by User
        $user = User::find(auth()->user()->id);
        $user->password = bcrypt(request('password'));
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Password updated successfully');
    }
}
