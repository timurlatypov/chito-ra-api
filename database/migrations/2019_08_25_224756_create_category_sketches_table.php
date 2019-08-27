<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorySketchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_sketches', function (Blueprint $table) {
	        $table->increments('id');
	        $table->integer('category_id')->unsigned();
	        $table->integer('image_id')->unsigned();

	        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
	        $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_sketches');
    }
}
