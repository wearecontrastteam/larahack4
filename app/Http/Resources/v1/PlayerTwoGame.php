<?php

namespace App\Http\Resources\v1;

use App\Game;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerTwoGame extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->format($this->resource);
    }

    private function format(Game $game)
    {
        $winner = '';
        if($game->winner_id !== null) {
            $winner = ($game->winner_id == $game->player_two_id) ? 'You win!' : 'You lose!';
        }

        return [
            'id' => encrypt($game->id),
            'current_player' => $game->current_player,
            'people' => $game->people,
            'state' => $game->player_two_state,
            'person' => $game->player_two_person,
            'opponent' => optional($game->player_one)->name,
            'player' => 'player-2',
            'player_number' => 2,
            'subturn' => $game->subturn_id,
            'status' => $game->status_id,
            'winner' => $winner,
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'ok'
        ];
    }
}
