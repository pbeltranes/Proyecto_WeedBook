<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Strain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strains', function(Blueprint $table){
            $table->increments('id');
            $table -> integer('review_id') -> unsigned() -> default(0);
            $table->foreign('review_id')
                ->references('id')->on('reviews')
                ->onDelete('cascade');
            $table->string('type'); // feminizada , automatica
            $table->string('bank'); /
            $table->string('strain_name');
            $table->string('technique');
            $table->date('germ_start');
            $table->date('veg_start');
            $table->date('flow_start');
            $table->date('harvest_date');
            $table->boolean('active'); //
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
        Schema::drop('strains');
    }
}
