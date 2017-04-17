<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBackgroundImageUrlToReviewsAndUpdateImageUrlToStrainsUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function($table){
            $table->string('background_image_url');
        });
        Schema::table('strain_updates', function($table){
            $table->string('update_image_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('reviews', function($table){
            $table->dropColumn('background_image_url');
        });
        Schema::table('strain_updates', function($table){
            $table->dropColumn('update_image_url');
        });

    }
}
