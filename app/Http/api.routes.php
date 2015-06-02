<?

/**
 * /auth
 */
Route::post('/auth/login', 'AuthController@login');


Route::group(['middleware' => 'checktoken'], function(){
    /**
     * /users
     */
    Route::resource('users','UserController');

    /**
     * /foods
     */
    Route::resource('foods','FoodController');

    /**
     * /fridges
     */
    Route::resource('fridges','FridgeController');


    /**
     * /custom-lists
     */
    Route::resource('custom-lists','CustomListController');

    Route::post('/auth/logout', 'AuthController@logout');

});