<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        // Count the leaderboard
//        $wins = [];
//
//        $games = Game::all();
//
//        foreach($games as $game) {
//            $winner = null;
//            if($game->winner_id == 1) {
//                $winner = $game->player_one->id;
//            }
//            if($game->winner_id == 2) {
//                $winner = $game->player_two->id;
//            }
//
//            var_dump($winner);
//
//            if($winner) {
//                $win_count = $wins[$winner->id] ?? 0;
//            }
//        }

        return view('home');
    }
}
