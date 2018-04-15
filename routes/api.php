<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('AuthToken')->group(function () {
  //Recipe Functions
  Route::post('/recipe/edit/{id}','RecipeController@update');
  Route::post('/recipe/add','RecipeController@store');
  Route::post('/recipe/edit/{id}','RecipeController@update');
  Route::get('/recipe/{id}','RecipeController@show');
  Route::post('/recipe/delete/{id}','RecipeController@destroy');

  //Review Functions
  Route::post('/review/add/{id}','ReviewController@store');//Add Review
  Route::get('/review/{id}','ReviewController@show'); //Get Reviews
  Route::post('/review/delete/{id}','ReviewController@destroy');

  //Favourite Functions
  Route::get('/favourite/count/{id}','FavouriteController@count');
  Route::post('/favourite/add/{recipeId}','FavouriteController@store');
  Route::post('/favourite/remove/{recipeId}','FavouriteController@destroy');

});
Route::post('/login','AccountController@login');
Route::post('/register','AccountController@register');
Route::get('/recipe/{id}','RecipeController@show');
