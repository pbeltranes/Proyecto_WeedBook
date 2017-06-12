<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTimespamptsOnStrains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('strains', function($table) {
            $table->dropColumn('germ_start');
            $table->dropColumn('veg_start');
            $table->dropColumn('flow_start');
            $table->dropColumn('harvest_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('strains', function($table){
            $table->date('germ_start');
            $table->date('veg_start');
            $table->date('flow_start');
            $table->date('harvest_date');
        });
    }
}
