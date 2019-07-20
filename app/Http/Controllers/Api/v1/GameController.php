<?php

namespace App\Http\Controllers\Api\v1;

use App\Game;
use App\Http\Resources\v1\PlayerOneGame;
use App\Http\Resources\v1\PlayerTwoGame;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameController extends Controller
{

    public function index(Game $game)
    {
        if(!$game->isPlayer(auth()->id())){
            return ['status' => 'error', 'error' => 'You are not a player in this game'];
        }

        if($game->isPlayerOne(auth()->id())){
            return new PlayerOneGame($game);
        } elseif($game->isPlayerTwo(auth()->id())){
            return new PlayerTwoGame($game);
        }

        return ['status' => 'error', 'error' => 'Unknown Error'];
    }

}
