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
            'winner' => $game->winner_id,
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'ok'
        ];
    }
}
