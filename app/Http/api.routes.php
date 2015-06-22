<?php

/**
 * /auth
 */
Route::post('/auth/login', 'AuthController@login');

Route::get('/', function(){
    return response()->json(['Bienvenue sur le webservice de l\'application No waste']);
});


Route::get('/test', function(){
    return response()->json(['Ceci est la page de test en requête GET']);
});

Route::post('/test', function(){
    return response()->json(['Ceci est la page de test en requête POST']);
});

Route::group(['middleware' => 'checktoken'], function(){
    /**
     * /users
     */
    Route::group(['prefix' => 'users'], function(){
        Route::get('fridges', 'UserController@getOwnFridges');
        Route::get('watching-fridges', 'UserController@getWatchingFridges');
        Route::get('custom-lists', 'UserController@getCustomLists');
    });
    Route::resource('users','UserController');

    /**
     * /foods
     */
    Route::resource('foods','FoodController');

    /**
     * /fridges
     */
    Route::group(['prefix' => 'fridges'], function(){
        Route::get('/{id}/foods', 'FridgeController@getFoods');
    });
    Route::resource('fridges','FridgeController');


    /**
     * /custom-lists
     */
    Route::resource('custom-lists','CustomListController');

    /**
     * /auth/logout
     */
    Route::post('/auth/logout', 'AuthController@logout');

});