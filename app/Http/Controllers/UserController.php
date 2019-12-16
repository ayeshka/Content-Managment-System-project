<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index')->with('users', User::all());
    }

    public function makeAdmin(User $user)
    {
       $user->role = 'admin';

       $user->save();

       session()->flash('success','Make admin successfully.');

       return redirect(route('users.index'));
    }
}
