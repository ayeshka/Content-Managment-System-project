<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Categary extends Model
{
    protected $fillable = ['name'];


    public function posts(){           // category has meny posts
        //return $this->hasMany(Post::class);
        return $this->hasMany('App\Post');
    }
}
