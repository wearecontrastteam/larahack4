<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Game
 *
 * @property-read \App\User $player_one
 * @property-read \App\User $player_two
 * @property-read \App\GameStatus $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $player_one_id
 * @property int|null $player_two_id
 * @property int $status_id
 * @property int|null $current_player
 * @property mixed|null $player_one_state
 * @property mixed|null $player_two_state
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereCurrentPlayer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game wherePlayerOneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game wherePlayerOneState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game wherePlayerTwoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game wherePlayerTwoState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereUpdatedAt($value)
 * @property mixed|null $people
 * @property int|null $player_one_person_id
 * @property int|null $player_two_person_id
 * @property int|null $winner_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game wherePeople($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game wherePlayerOnePersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game wherePlayerTwoPersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereWinnerId($value)
 * @property-read \App\Person $player_one_person
 * @property-read \App\Person $player_two_person
 * @property-read \App\User $winner
 */
class Game extends Model
{
    protected $fillable = ['player_one_id', 'status_id'];

    public function player_one()
    {
        return $this->belongsTo(User::class);
    }

    public function player_two()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->hasOne(GameStatus::class);
    }

    public function player_one_person()
    {
        return $this->belongsTo(Person::class);
    }

    public function player_two_person()
    {
        return $this->belongsTo(Person::class);
    }

    public function winner()
    {
        return $this->hasOne(User::class);
    }

    public function isAwaitingOpponent()
    {
        return $this->status_id === GameStatus::MATCHING;
    }

    public function isPlayer(int $id)
    {
        return $this->player_one_id === $id
            || $this->player_two_id === $id;
    }

    public function isPlayerOne(int $id)
    {
        return $id === $this->player_one_id;
    }

    public function isPlayerTwo(int $id)
    {
        return $id === $this->player_two_id;
    }

}
