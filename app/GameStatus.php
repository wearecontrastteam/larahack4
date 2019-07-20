<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameStatus extends Model
{
    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
