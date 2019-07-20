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
            'player_two_state' => $game->player_two_state,
            'player_two_person' => $game->player_two_person,
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'ok'
        ];
    }
}
