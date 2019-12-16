<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categary;
use App\Tag;
use App\Post;

class WelcomeController extends Controller
{
    public function welcome()
    {
        return view('welcome')->with('categories',Categary::all())
        ->with('tags',Tag::all())
        ->with('posts', Post::all());
    }
}
