<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function show(Post $post)
    {
        return view('blog.blog')->with('posts', $post);
    }
}
