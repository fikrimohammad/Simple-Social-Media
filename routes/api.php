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

Route::get('/users/list', 'UserController@index')->name('users.index');
Route::post('/users/create', 'UserController@create')->name('users.create');
Route::get('/users/{user}/manager', 'UserController@show_manager')->name('users.manager');
Route::put('/users/{user}/manager', 'UserController@assign_manager')->name('users.assign_manager');
Route::get('/users/{user}/subordinates', 'UserController@show_subordinates')->name('users.subordinates');
Route::put('/users/{user}', 'UserController@update')->name('users.update');
Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');
