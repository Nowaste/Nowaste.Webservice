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

    Route::post('/auth/logout', 'AuthController@logout');

});