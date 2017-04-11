<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Review extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function(Blueprint $table){
            $table->increments('id');
            $table -> integer('author_id') -> unsigned() -> default(0);
            $table->foreign('author_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->integer('strain_number');
            $table->string('title')->unique(); // nombre
            $table->string('state'); // hidroponico , exterior, feminizada , interior
            $table->boolean('active'); // activo , terminado
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
        Schema::drop('reviews');
    }
}
