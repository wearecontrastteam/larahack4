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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->name('v1.')->middleware('auth:api')->group(function (){
    Route::prefix('game/{game_hash}')->name('game.')->group(function(){
        Route::get('/', 'GameController@index')->name('index');
        Route::post('/', 'GameController@update')->name('update');
        Route::post('/guess', 'GameController@guess')->name('guess');
    });
});
