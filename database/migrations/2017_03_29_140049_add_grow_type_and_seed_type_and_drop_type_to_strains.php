<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGrowTypeAndSeedTypeAndDropTypeToStrains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('strains', function($table) {
            $table->string('grow_type');
            $table->string('seed_type');
            $table->dropColumn('type');
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
            $table->dropColumn('grow_type');
            $table->dropColumn('seed_type');
            $table->string('type');
        });
    }
}
