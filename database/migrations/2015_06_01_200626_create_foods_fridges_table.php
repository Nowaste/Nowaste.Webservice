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

            $table->increments('id');

            $table->date('out_of_date');
            $table->date('consumed_date')->nullable();
            $table->integer('quantity')->nullable();
            $table->boolean('visible')->nullable();
            $table->boolean('open')->nullable();
        });

        Schema::table('foods', function(Blueprint $table)
        {
            $table->integer('food_fridge_id')->unsigned()->nullable();
            $table->foreign('food_fridge_id')->references('id')->on('food_fridge');
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

        Schema::table('foods', function(Blueprint $table)
        {
            $table->dropForeign('foods_food_fridge_id_foreign');
            $table->dropColumn('food_fridge_id');
        });
    }

}
