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
        'user_id'
    ];

    /**
     * Represents a performer, typically an artist or musician.
     *
     * This model stores the performer's details such as name and social media links,
     * and defines relationships to their discographies, news, and songs.
     *
     * @property int $id Unique identifier for the performer
     * @property int $user_id ID of the user associated with the performer
     * @property string $name Name of the performer
     * @property string|null $instagram Instagram username
     * @property string|null $facebook Facebook username
     * @property string|null $x X (formerly Twitter) username
     * @property string|null $youtube YouTube channel name or link
     *
     * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Discography[] $discographies Albums, EPs, etc.
     * @property \Illuminate\Database\Eloquent\Collection|\App\Models\News[] $news News articles created by the performer
     * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Song[] $songs Songs by the performer
     */


    /**
     * Get the discographies (albums, EPs, etc.) associated with the performer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discographies()
    {
        return $this->hasMany(Discography::class);
    }

    /**
     * Get the news articles written by the performer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function news()
    {
        return $this->hasMany(News::class);
    }


    /**
     * Get the songs associated with the performer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}
