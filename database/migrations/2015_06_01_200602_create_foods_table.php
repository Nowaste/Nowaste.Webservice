<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('foods', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->timestamps();

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('fridge_id')->unsigned()->nullable();
//            $table->foreign('fridge_id')->references('id')->on('fridge');

            $table->integer('custom_list_id')->unsigned()->nullable();
//            $table->foreign('custom_list_id')->references('id')->on('custom_list');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('foods');
	}

}
