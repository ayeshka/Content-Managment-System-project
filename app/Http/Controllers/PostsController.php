<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\PostsCreatingRequest;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

// php artisan make:controller PostsController --resource

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreatingRequest $request)
    {
        // upload the image
        // craete the post
        // flash massage
        // reditect user



      $image = $request->image->store('posts'); // assing image for use later and this image store the store folder

       Post::create([
         'title' => $request->title,
         'description' => $request->description,
         'content' => $request->content,
         'image' => $image
       ]);

       session()->flash('success','Post Create Successfully');

       return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // when we use route model binding laravel try to find this post from database which means route model binding can not help us in this case
        // so what we want to do is simply take a id which means not use route model binding and faind our post on sourse

        $post = Post::withTrashed()->where('id', $id)->firstorFail();

        // using firstorFail method if it does not find a record it's going to throw and exception and laravel going to catch that exception and show us to all for four pages
        // so we automatically see for all four pages when the user trying to delete  a post dosen't exist

        if ($post->trashed())
        {
            Storage::delete($post->image);  // when we delete the  permenantly,  image should also delete in the storage
            $post->forceDelete();
        }
        else{
            $post->delete();
        }


        session()->flash('success','Post Delete Successfully');

         return redirect(route('posts.index'));
    }

      /**
     * Display a list of trush posts.
     *
     * @return \Illuminate\Http\Response
     */

    public function trashed(){

        $trushed = Post::withTrashed()->get();


       // return view('posts.index')->withPosts($trushed);
         return view('posts.index')->with('posts',$trushed);
         //As noted above, soft deleted models will automatically be excluded from query results. However, you may force soft deleted models to appear in a result set using the withTrashed method on the query:

    }
}
