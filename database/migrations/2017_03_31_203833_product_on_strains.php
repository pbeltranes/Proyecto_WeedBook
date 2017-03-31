<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductOnStrains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_on_strains', function (Blueprint $table) {
          $table->increments('id');
          $table -> integer('products_id') -> unsigned() -> default(0);
          $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');
          $table -> integer('strains_id') -> unsigned() -> default(0);
          $table->foreign('strains_id')->references('id')->on('strains')->onDelete('cascade');
          $table->date('date_start');
          $table->date('date_end');
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
        Schema::drop('product_on_strains');
    }
}
