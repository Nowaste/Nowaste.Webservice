<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFridgesWatchersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('fridge_watchers', function(Blueprint $table)
        {

            $table->integer('fridge_id')->unsigned()->nullable();
            $table->foreign('fridge_id')->references('id')->on('fridges');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->primary(['fridge_id', 'user_id']);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('fridge_watchers');
    }

}
