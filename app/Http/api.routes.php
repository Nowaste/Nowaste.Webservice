<?
/**
 * /users
 */
Route::resource('users','UserController');
Route::get('/login', 'UserController@login');
Route::post('/logout', 'UserController@logout');

/**
 * /foods
 */
Route::resource('foods','FoodController');

/**
 * /fridges
 */
Route::resource('fridges','FridgeController');