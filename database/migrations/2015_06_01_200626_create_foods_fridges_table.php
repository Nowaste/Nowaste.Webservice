<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodsFridgesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('food_fridge', function(Blueprint $table)
        {

            $table->integer('food_id')->unsigned()->nullable();
            $table->foreign('food_id')->references('id')->on('foods');

            $table->integer('fridge_id')->unsigned()->nullable();
            $table->foreign('fridge_id')->references('id')->on('fridges');

            $table->primary(['food_id', 'fridge_id']);

            $table->date('out_of_date');
            $table->date('consumed_date')->nullable();
            $table->integer('quantity')->nullable();
            $table->boolean('visible')->nullable();
            $table->boolean('open')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('food_fridge');
    }

}
