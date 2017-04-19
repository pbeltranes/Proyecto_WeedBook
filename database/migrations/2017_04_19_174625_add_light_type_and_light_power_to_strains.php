<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLightTypeAndLightPowerToStrains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('strains', function($table) {
            $table->string('light_type');
            $table->integer('light_power');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('strains', function($table) {
            $table->dropColumn('light_type');
            $table->dropColumn('light_power');
        });
    }
}
