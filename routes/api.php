<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1', 'namespace' => 'API\v1'], function () {
    Route::post('/login', 'AuthController@login');
});

Route::group(['middleware' => 'check.token','prefix' => 'v1', 'namespace' => 'API\v1'], function(){
    Route::get('/movie', 'MovieController@index'); 
    Route::get('/movie/history', 'MovieController@history');
    Route::post('/movie/create', 'MovieController@create'); 
    Route::put('/movie/edit/{id}', 'MovieController@edit');
    Route::delete('/movie/destroy/{id}', 'MovieController@destroy');
    Route::patch('/movie/restore/{id}', 'MovieController@restore');
}); 