<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\GameSubturn
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Game[] $games
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameSubturn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameSubturn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameSubturn query()
 * @mixin \Eloquent
 */
class GameSubturn extends Model
{
    public const ASK_QUESTION = 1;
    public const WAIT_FOR_QUESTION_ANSWER = 2;
    public const FLIP_FACES = 3;

    protected $fillable = ['id', 'status', 'description'];

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
