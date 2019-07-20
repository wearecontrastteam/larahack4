<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class Game extends JsonResource
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

    public function format(Game $game)
    {
        return [
            'id' => $game->id,
            'player_one' => $game->player_one->name,
            'player_two' => optional($game->player_two)->name,
            'status' => $game->status,
            'winner' => optional($game->winner)->name,
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'ok'
        ];
    }
}
