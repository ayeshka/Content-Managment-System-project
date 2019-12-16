<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\profile\UpdateProfileRequest;

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

    public function edit() {
        return view('user.edit')->with('users',auth()->user());
    }

    public function update(UpdateProfileRequest $request)
    {
   //dd($request->about);

        $user = auth()->user();

        $user->update([
          'name' => $request->name,
          'about' => $request->about
        ]);

        session()->flash('success','Profile update successfully');

        return redirect(route('users.index'));


    }
}
