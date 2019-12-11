<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToPosstsTable extends Migration
{


// let's think we add softdelete coloum to the create_post_table then what happend is when after migrate clear the all the coloum then delete all the value in the table
// let's think if we have lot of value in the table then after migrate would be  delete all the value this is desadvantage
// create this coloum we use "php artisan make:migration add_soft_deletes_to_possts_table --table=posts"

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) { // this will modify the posts table
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) { // when we wont to delete this coloum "php artisan migrate:rollback"
            $table->dropColumn('deleted_at');
        });
    }
}
