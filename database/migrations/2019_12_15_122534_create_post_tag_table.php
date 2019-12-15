<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{

    /**
     *php artisan make:migration create_post_tag_table in meny to many relationship hete post and tag shuold be singula
     *and secondly name should be alphbetical order like post_tag
     *table is derived from the alphabetical order of the related model names
     */

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('post_id'); // this name should be sigular and _id and equle to the model name
            $table->integer('tag_id'); // this name should be singular and _id and equal to the model name
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
