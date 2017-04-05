<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentUpVoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_up_votes', function(Blueprint $table){
            $table->increments('id');
            $table->integer('comment_id') -> unsigned() -> default(0);
            $table->foreign('comment_id')
                ->references('id')->on('comments')
                ->onDelete('cascade');
            $table->integer('user_id') -> unsigned() -> default(0);
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comment_up_votes');
    }
}
