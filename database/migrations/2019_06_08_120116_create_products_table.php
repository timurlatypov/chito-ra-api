<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
	        $table->string('slug')->unique();
            $table->longText('description')->nullable();
	        $table->integer('price')->nullable();
            $table->tinyInteger('order')->nullable();
            $table->boolean('spicy')->default(false);
            $table->boolean('top')->default(false);
            $table->boolean('deliverable')->default(true);
            $table->boolean('live')->default(false);
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
        Schema::dropIfExists('products');
    }
}
