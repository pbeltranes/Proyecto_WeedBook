<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedAtAndUpdatedAtOnApiBanksAndApiStrains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('api_banks', function($table){
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
        Schema::table('api_strains', function($table){
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
        
        Schema::table('api_banks', function($table){
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
        Schema::table('api_strains', function($table){
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
