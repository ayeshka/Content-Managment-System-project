<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();


// when we want to add middeware to the all this routes the we can use route group like this
Route::middleware(['auth'])->group(function() {   // if user authenticated then user can visit this route
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories','CategoriController');
    Route::resource('posts','PostsController');
    Route::resource('tags','TagsController');
    Route::get('trush_post','PostsController@trashed')->name('trashed-posts.index');
    Route::put('restore-post/{post}', 'PostsController@restore')->name('restore-posts');
});


   Route::middleware(['auth','admin'])->group(function() {
    Route::get('user', 'UserController@index')->name('user.index');
   });

