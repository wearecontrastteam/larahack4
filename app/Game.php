<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function player_one()
    {
        return $this->hasOne(User::class);
    }

    public function player_two()
    {
        return $this->hasOne(User::class);
    }

    public function status()
    {
        return $this->hasOne(GameStatus::class);
    }

}
