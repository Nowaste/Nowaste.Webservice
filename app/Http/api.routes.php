<?

/**
 * /auth
 */
Route::post('/auth/login', 'AuthController@login');


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