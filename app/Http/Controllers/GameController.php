<?php

namespace App\Http\Controllers;

use App\Game;
use App\GameStatus;
use App\Person;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function create()
    {
        $people = Person::inRandomOrder()->take(24)->get();

        $game = new Game();
        $game->player_one_id = auth()->id();
        $game->status_id = GameStatus::CREATING;
        $game->people = $people;
        $game->player_one_person_id = $people->random(1)->id;
        $game->player_two_person_id = $people->random(1)->id;
        $game->save();

        return redirect()->route('game.play', encrypt($game->id));
    }

    public function join(Game $game)
    {
        if($game->isAwaitingOpponent()){
            $game->player_two_id = auth()->id();
            $game->current_player = rand(1,2);
            $game->save();

            return redirect()->route('game.play', encrypt($game->id));
        }

        return redirect()->route('game.invalid');
    }

    public function play(Game $game)
    {
        if(!$game->isPlayer(auth()->id())) {
            return redirect()->route('game.invalid');
        }

        return view('game.play')
            ->with('game_id', encrypt($game->id));
    }

    public function invalid()
    {
        return view('game.invalid');
    }
}
