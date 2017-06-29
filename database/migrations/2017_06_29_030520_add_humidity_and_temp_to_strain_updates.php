<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHumidityAndTempToStrainUpdates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('strain_updates', function($table) {
            $table->integer('humidity');
            $table->integer('temp');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('strain_updates', function($table) {
            $table->dropColumn('humidity');
            $table->dropColumn('temp');
            
        });
    }
}
