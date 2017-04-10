<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStrainUpdates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strain_updates', function(Blueprint $table){
            $table->increments('id');
            $table->integer('strain_id') -> unsigned() -> default(0);
            $table->foreign('strain_id')
                ->references('id')->on('strains')
                ->onDelete('cascade');
            $table->float('height');
            $table->float('darkness_time');
            $table->float('light_time');
            $table->string('stage');
            $table->float('veg_prod_quantity');
            $table->float('flow_prod_quantity');
            $table->float('other_prod_quantity');
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
        Schema::drop('strain_updates');
    }
}
