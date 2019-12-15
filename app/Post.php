<?php

namespace App;

use App\Categary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

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
      'title', 'description', 'content', 'image', 'published_at', 'categary_id'
    ];

    /**
     *
     * @return void
     */

    public function deleteimage(){
        Storage::delete($this->image);
    }

    public function categary(){  // define a relationship  ,funtion name should be name of the model, posts belongs to category
     return $this->belongsTo(Categary::class );
     // return $this->belongsTo('App\Categary');
    }

    public function tags(){ // many to many relationship function name should be plural
    return $this->belongsToMany(Tag::class);
    }
}
