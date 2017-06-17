<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topping_categories', function (Blueprint $table){
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('toppings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topcat_id')->unsigned();
            $table->foreign('topcat_id')->references('id')->on('topping_categories')->onDelete('cascade');
            $table->string('slug');
            $table->string('name');
            $table->text('image');
            $table->integer('price');
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
        Schema::dropIfExists('toppings');
        Schema::dropIfExists('topping_categories');
    }
}
