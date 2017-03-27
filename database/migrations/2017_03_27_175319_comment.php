<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Comment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function(Blueprint $table){
      $table->increments('id');
      $table -> integer('on_review') -> unsigned() -> default(0);
      $table->foreign('on_review')
          ->references('id')->on('reviews')
          ->onDelete('cascade');
      $table -> integer('from_user') -> unsigned() -> default(0);
      $table->foreign('from_user')
          ->references('id')->on('users')
          ->onDelete('cascade');
      $table->text('body');
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
        Schema::drop('comments');
    }
}
