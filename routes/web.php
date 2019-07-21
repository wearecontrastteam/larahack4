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


    Route::namespace('Api')->prefix('api')->name('api.')->group(function() {
        Route::prefix('v1')->name('v1.')->namespace('v1')->group(function () {
            Route::get('games/matching', 'GameController@matching')->name('game.matching');
            Route::get('games/recent', 'GameController@recent')->name('game.recent');

            Route::prefix('game/{game_hash}')->name('game.')->group(function () {
                Route::get('/', 'GameController@show')->name('show');
                Route::post('/', 'GameController@update')->name('update');
                Route::post('/ask', 'GameController@ask')->name('ask');
                Route::post('/answer', 'GameController@answer')->name('ask');
                Route::post('/guess', 'GameController@guess')->name('guess');
                Route::post('/endturn', 'GameController@endturn')->name('endturn');
            });
        });
    });

    Route::get('pusher-example', function() {
        return view('pusher-example');
    });

    Route::get('pusher-send/{game_id}', function($game_id) {
        $pusher = new Pusher\Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            array('cluster' => env('PUSHER_APP_CLUSTER'))
        );

        $game_id = decrypt($game_id);
        $channel = "game-" . sha1($game_id);
        //dd($channel);

        $pusher->trigger($channel, 'game-updated', [
            'message' => '1'
        ]);

        $pusher->trigger($channel, 'question', [
            'message' => 'Grey hair?'
        ]);

        return "OK";
    });

});