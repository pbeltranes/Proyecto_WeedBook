<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_profiles', function(Blueprint $table){
            $table->increments('id');
            $table -> integer('user_id') -> unsigned() -> default(0);
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('user_name');
            $table->string('bio');
            $table->date('growing_since');
            $table->date('birthdate');
            $table->string('avatar_url');
            $table->integer('comment_rep');
            $table->integer('review_rep');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_profiles');
    }
}
