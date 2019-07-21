<?php

namespace App\Http\Controllers;

use App\Game;
use App\GameStatus;
use App\GameSubturn;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Pusher\Pusher;

class GameController extends Controller
{
    public function create()
    {
        $people = Person::inRandomOrder()->take(24)->get();

        $game = new Game();
        $game->player_one_id = auth()->id();
        $game->status_id = GameStatus::MATCHING;
        $game->people = $people;
        $game->player_one_person_id = $people->random()->id;
        $game->player_two_person_id = $people->random()->id;
        $game->player_one_state = $this->generatePlayerState($people);
        $game->player_two_state = $this->generatePlayerState($people);
        $game->save();

        return redirect()->route('game.play', encrypt($game->id));
    }

    /**
     * @param Person[] $people
     * @return array
     */
    private function generatePlayerState($people)
    {
        $state = collect([]);
        foreach($people as $person){
            $state->push(['id' => $person->id, 'state' => 1]);
        }
        return $state->toArray();
    }

    public function join(Game $game)
    {
        $pusher = new Pusher(
            config('services.pusher.app_key'),
            config('services.pusher.app_secret'),
            config('services.pusher.app_id'),
            array('cluster' => config('services.pusher.app_cluster'))
        );

        $channel = "game-" . sha1($game->id . config('app.chat_hash_secret'));


        if($game->isPlayer(auth()->id())){
            return redirect()->route('game.play', encrypt($game->id));
        }

        if(!$game->isAwaitingOpponent()){
            return redirect()->route('game.invalid')
                ->with('message', 'You cannot join this game');
        }

        if($game->isAwaitingOpponent()){
            $game->player_two_id = auth()->id();
            $game->current_player = rand(1,2);
            $game->status_id = GameStatus::IN_PROGRESS;
            $game->subturn_id = GameSubturn::ASK_QUESTION;
            $game->save();

            $pusher->trigger($channel, 'game-updated', []);

            return redirect()->route('game.play', encrypt($game->id));
        }

        return redirect()->route('game.invalid')
            ->with('message', 'Unknown error');
    }

    public function play(Game $game)
    {
        if(!$game->isPlayer(auth()->id())) {
            return redirect()->route('game.invalid');
        }

        return view('game.play')
            ->with('game_id', encrypt($game->id))
            ->with('game_id_hashed', sha1($game->id . config('app.chat_hash_secret')));
    }

    public function invalid()
    {
        dd(session('message'));
        return view('game.invalid');
    }
}
