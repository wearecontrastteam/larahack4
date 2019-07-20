<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'WelcomeController@index')->name('welcome');

Route::middleware('auth')->group(function(){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/lobby', 'LobbyController@index')->name('lobby.index');

    Route::get('/game/create', 'GameController@create')->name('game.create');
    Route::get('/game/{game_hash}/join', 'GameController@join')->name('game.join');
    Route::get('/game/{game_hash}', 'GameController@play')->name('game.play');
    Route::get('/game/invalid', 'GameController@invalid')->name('game.invalid');

    Route::prefix('admin')->name('admin.')->group(function(){

        Route::get('/', 'AdminController@index')->name('index');
        Route::post('/add-person', 'AdminController@add_person')->name('add_person');

    });

});