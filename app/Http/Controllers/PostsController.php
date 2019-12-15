<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Categary;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\PostsCreatingRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

// php artisan make:controller PostsController --resource

    public function __construct(){
        $this->middleware('verifyCategoryCount')->only(['create','store']);// You may even restrict the middleware to only certain methods on the controller class
        // here create and store in the only methode is method of the PostController class
    }

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
        return view('posts.create')->with('categorys', Categary::all())->with('tags', Tag::all());
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

     $post =  Post::create([
         'title' => $request->title,
         'description' => $request->description,
         'content' => $request->content,
         'image' => $image,
         'published_at' => $request->publish_at,
         'categary_id' => $request->category
       ]);

       if($request->tags){
           $post->tags()->attach($request->tags); // post and tag tables are attach according to tags id, like post_id 1 -> tags_id 2, post_id 1-> tags_id 3
       }

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
    public function edit(Post $post)
    {
       // dd($post->tags->pluck('id')->toArray());
      return view('posts.create')->with('posts', $post)->with('categorys', Categary::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request,Post $post)
    {
        $data = $request->only(['title','description','published_at', 'content', 'categary_id']); // upload attributes

        //check if new image
        if($request->hasFile('image')){

            $image = $request->image->store('posts'); // upload new image


            $post->deleteimage(); // delete old image from storage

            $data['image'] = $image;
        }

        if($request->tags){
            $post->tags()->sync($request->tags);

            /**
             * this sync method is healpful method for many to many relationship
             * what is gonna do is it's just going to check the requrest tag fo the form if this tag
             * where already attached to those post  then it's just gonna leave them at that but
             *if threr are any tag from the form that where not attached
             *then is gonna attach them but then those where not selected is gonna attach them
             *
             *
             *
             *
             */
        }


        $post->update($data); // update data

        session()->flash('success','Post Update Successfully');

         return redirect(route('posts.index'));


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
            $post->deleteimage();  // when we delete the  permenantly,  image should also delete in the storage
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

        $trushed = Post::onlyTrashed()->get(); // get us only the trashed post


       // return view('posts.index')->withPosts($trushed);
         return view('posts.index')->with('posts',$trushed);
         //As noted above, soft deleted models will automatically be excluded from query results. However, you may force soft deleted models to appear in a result set using the withTrashed method on the query:

    }

    public function restore($id) {

    $post = Post::withTrashed()->where('id', $id)->firstOrFail();
    $post->restore(); // restore the post

    session()->flash('success','Post Restore Successfully');

    return redirect()->back();
    }
}
