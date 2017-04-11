<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_updates', function(Blueprint $table){
            $table->increments('id');
            $table->integer('review_id') -> unsigned() -> default(0);
            $table->foreign('review_id')
                ->references('id')->on('reviews')
                ->onDelete('cascade');
            $table->string('update_text');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('review_updates');
    }
}
