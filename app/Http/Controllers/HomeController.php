<?php

namespace App\Http\Controllers;

use App\Game;
use App\User;
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
        // Count the leaderboard
        $wins = [];

        $games = Game::all();

        foreach($games as $game) {

            if($game->winner_id) {
                $wins_so_far = $wins[$game->winner_id] ?? 0;
                $wins[$game->winner_id] = $wins_so_far + 1;
            }
        }

        arsort($wins);

        $wins_by_name = [];
        foreach($wins as $winner_id => $win_count) {
            $user = User::find($winner_id);
            $wins_by_name []= [$user, $win_count];
        }

        return view('home', [
            'wins_by_name' => $wins_by_name,
        ]);
    }
}
