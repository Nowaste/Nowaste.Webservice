<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDelete extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('configurations', function(Blueprint $table){
            $table->softDeletes();
        });
        Schema::table('custom_lists', function(Blueprint $table){
            $table->softDeletes();
        });
        Schema::table('food_fridge', function(Blueprint $table){
            $table->softDeletes();
        });
        Schema::table('foods', function(Blueprint $table){
            $table->softDeletes();
        });
        Schema::table('fridge_watchers', function(Blueprint $table){
            $table->softDeletes();
        });
        Schema::table('fridges', function(Blueprint $table){
            $table->softDeletes();
        });
        Schema::table('users', function(Blueprint $table){
            $table->softDeletes();
        });
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('configurations', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
        Schema::table('custom_lists', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
        Schema::table('food_fridge', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
        Schema::table('foods', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
        Schema::table('fridge_watchers', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
        Schema::table('fridges', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
        Schema::table('users', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
	}

}
