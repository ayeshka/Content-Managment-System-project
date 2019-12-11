<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected  $fillable = [                     // create a property colled protected
      'title', 'description', 'content', 'image', 'published_at'
    ];
}
