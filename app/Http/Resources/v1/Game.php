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

    public function format(\App\Game $game)
    {
        $gameId = encrypt($game->id);
        return [
            'id' => $gameId,
            'player_one' => $game->player_one->name,
            'player_two' => optional($game->player_two)->name,
            'status' => $game->status,
            'winner' => optional($game->winner)->name,
            'created' => $game->created_at,
            'join_url' => route('game.join', $gameId)
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'ok'
        ];
    }
}
