<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Person
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $username
 * @property int $github_id
 * @property string $photo_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereGithubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person wherePhotoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereUsername($value)
 */
class Person extends Model
{
    protected $fillable = ['login', 'github_id', 'avatar_url', 'bio', 'name'];


}
