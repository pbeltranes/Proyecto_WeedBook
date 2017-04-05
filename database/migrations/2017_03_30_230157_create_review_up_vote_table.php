<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateReviewUpVoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_up_votes', function(Blueprint $table){
            $table->increments('id');
            $table->integer('review_id') -> unsigned() -> default(0);
            $table->foreign('review_id')
                ->references('id')->on('reviews')
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
        Schema::drop('review_up_votes');
    }
}

