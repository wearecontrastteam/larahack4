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
    public const CREATING = 1;
    public const MATCHING = 2;
    public const IN_PROGRESS = 3;
    public const FINISHED = 4;
    public const ERROR = 5;

    protected $fillable = ['id', 'status', 'description'];

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
