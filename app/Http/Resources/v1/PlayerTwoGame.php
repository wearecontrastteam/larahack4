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
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'ok'
        ];
    }
}
