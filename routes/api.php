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

Route::prefix('users')->group(function () {
    Route::get('', 'UserController@index');
    Route::post('', 'UserController@create');
    Route::get('{user}/manager', 'UserController@show_manager');
    Route::put('{user}/manager', 'UserController@assign_manager');
    Route::get('{user}/subordinates', 'UserController@show_subordinates');
    Route::put('{user}', 'UserController@update');
    Route::delete('{user}', 'UserController@destroy');

    Route::prefix('friends')->group(function () {
        Route::get('{user}/list', 'FriendshipController@list_friend');
        Route::get('request/{user}/list', 'FriendshipController@list_friend_request');
        Route::post('request/create', 'FriendshipController@create_friend_request');
        Route::put('request/{user}/approve', 'FriendshipController@approve_friend_request');
    });

    Route::prefix('conversations')->group(function () {
        Route::get('{user}/list', 'MessageController@list_conversation');
        Route::post('send_message', 'MessageController@send_message');
    });
});
