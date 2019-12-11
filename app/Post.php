<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{


// In addition to actually removing records from your database,
// Eloquent can also "soft delete" models. When models are soft deleted,
//they are not actually removed from your database. Instead,
//a deleted_at attribute is set on the model and inserted into the database.
//If a model has a non-null deleted_at value, the model has been soft deleted.
//To enable soft deletes for a model, use the Illuminate\Database\Eloquent\SoftDeletes trait on the model:
    
    use SoftDeletes;

    protected  $fillable = [                     // create a property colled protected
      'title', 'description', 'content', 'image', 'published_at'
    ];
}
