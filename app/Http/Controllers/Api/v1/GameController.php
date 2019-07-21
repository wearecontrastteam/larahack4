<?php

namespace App\Http\Controllers\Api\v1;

use App\Game;
use App\GameStatus;
use App\Http\Resources\v1\PlayerOneGame;
use App\Http\Resources\v1\PlayerTwoGame;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameController extends Controller
{

    public function matching()
    {
        return \App\Http\Resources\v1\Game::collection(
            Game::where('status_id', GameStatus::MATCHING)
                ->orderByDesc('updated_at')
                ->get()
        );
    }

    public function recent()
    {
        return \App\Http\Resources\v1\Game::collection(
            Game::where('status_id', GameStatus::FINISHED)
                ->orderByDesc('updated_at')
                ->take(10)
                ->get()
        );
    }

    public function show(Game $game)
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

    public function update(Request $request, Game $game)
    {
        if(!$game->isPlayer(auth()->id())){
            return ['status' => 'error', 'error' => 'You are not a player in this game'];
        }

        if($game->isPlayerOne(auth()->id())){
            return $this->updatePlayerOne($request, $game);
        } elseif($game->isPlayerTwo(auth()->id())){
            return $this->updatePlayerTwo($request, $game);
        }

        return ['status' => 'error', 'error' => 'Unknown Error'];
    }

    private function updatePlayerOne(Request $request, Game $game)
    {
        // TODO: Add validation
//        $game->current_player = $request->input('current_player');
        $game->player_one_state = $request->input('state');
        $game->save();

        return new PlayerOneGame($game);
    }

    private function updatePlayerTwo(Request $request, Game $game)
    {
        // TODO: Add validation
//        $game->current_player = $request->input('current_player');
        $game->player_two_state = $request->input('state');
        $game->save();

        return new PlayerTwoGame($game);
    }

    public function guess(Request $request, Game $game)
    {
        if(!$game->isPlayer()){
            return ['status' => 'error', 'error' => 'You are not a player in this game'];
        }

        if($game->isPlayerOne(auth()->id())){
            if($game->current_player !== 1){
                return ['status' => 'error', 'error' => 'You must wait until your turn to guess'];
            }

            if($game->player_two_person_id === decrypt($request->input('person_id'))){
                $game->winner_id = $game->player_one_id;
                $game->status_id = GameStatus::FINISHED;
                $game->save();

                return ['status' => 'ok', 'data' => [ 'result' => true ]];
            } else {
                return ['status' => 'ok', 'data' => [ 'result' => false ]];
            }
        }

        if($game->isPlayerTwo(auth()->id())){
            if($game->current_player !== 2){
                return ['status' => 'error', 'error' => 'You must wait until your turn to guess'];
            }

            if($game->player_one_person_id === decrypt($request->input('person_id'))){
                $game->winner_id = $game->player_two_id;
                $game->status_id = GameStatus::FINISHED;
                $game->save();

                return ['status' => 'ok', 'data' => [ 'result' => true ]];
            } else {
                return ['status' => 'ok', 'data' => [ 'result' => false ]];
            }
        }
    }

    public function ask(Game $game, Request $request)
    {
        $question = $request->get('question');

        $pusher = new \Pusher\Pusher(
            config('services.pusher.app_key'),
            config('services.pusher.app_secret'),
            config('services.pusher.app_id'),
            array('cluster' => config('services.pusher.app_cluster'))
        );

        $channel = "game-" . sha1($game->id . config('app.chat_hash_secret'));

        $player = null;

        if($game->isPlayerOne(auth()->id())) {
            $player = 1;
        }

        if($game->isPlayerTwo(auth()->id())) {
            $player = 2;
        }

        $pusher->trigger($channel, "player-$player-asks", [
            'message' => $question
        ]);

        $pusher->trigger($channel, 'game-updated', [
            'message' => 1
        ]);
    }

    public function answer(Game $game, Request $request)
    {
        $question = $request->get('question');

        $pusher = new \Pusher\Pusher(
            config('services.pusher.app_key'),
            config('services.pusher.app_secret'),
            config('services.pusher.app_id'),
            array('cluster' => config('services.pusher.app_cluster'))
        );

        $channel = "game-" . sha1($game->id . config('app.chat_hash_secret'));

        $player = null;

        if($game->isPlayerOne(auth()->id())) {
            $player = 1;
        }

        if($game->isPlayerTwo(auth()->id())) {
            $player = 2;
        }

        $pusher->trigger($channel, "player-$player-answers", [
            'message' => $question
        ]);

        $pusher->trigger($channel, 'game-updated', [
            'message' => 1
        ]);
    }
}
