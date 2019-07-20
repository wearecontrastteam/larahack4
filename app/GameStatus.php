<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\GameStatus
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Game[] $games
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameStatus query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $status
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameStatus whereUpdatedAt($value)
 */
class GameStatus extends Model
{
    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
