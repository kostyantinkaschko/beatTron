<?php

namespace App\Models;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Performer extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'performers';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'instagram',
        'facebook',
        'x',
        'youtube',
    ];

    /**
     * Represents a performer, typically an artist or musician.
     * This model stores the performer's details such as name and social media links,
     * and defines relationships to their discographies, news, and songs.
     *
     * @property int $id The unique identifier for the performer
     * @property int $user_id The identifier of the associated user
     * @property string $name The name of the performer
     * @property string|null $instagram The Instagram username of the performer
     * @property string|null $facebook The Facebook username of the performer
     * @property string|null $x The X (formerly Twitter) username of the performer
     * @property string|null $youtube The YouTube username of the performer
     * @property \Illuminate\Database\Eloquent\Collection|Discography[] $discographies The discographies associated with the performer
     * @property \Illuminate\Database\Eloquent\Collection|News[] $news The news articles created by the performer
     * @property \Illuminate\Database\Eloquent\Collection|Song[] $song The songs associated with the performer
     */


    public function discographies()
    {
        return $this->hasMany(Discography::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function song()
    {
        return $this->hasMany(Song::class);
    }
}
