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
        Route::post('/delete-person', 'AdminController@delete_person')->name('delete_person');

    });

    Route::get('pusher-example', function() {
        return view('pusher-example');
    });

    Route::get('pusher-send', function() {
        $pusher = new Pusher\Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            array('cluster' => env('PUSHER_APP_CLUSTER'))
        );

        $pusher->trigger('my-channel', 'game-updated', [
            'message' => '1'
        ]);

        $pusher->trigger('my-channel', 'chat-message', [
            'message' => 'Grey hair?'
        ]);

        return "OK";
    });

});