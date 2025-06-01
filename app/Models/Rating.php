<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    protected $table = 'songs_ratings';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'song_id',
        'rate',
    ];

    /**
     * Represents a rating given by a user to a song.
     * This model stores the rating value and defines relationships to the user and the song.
     *
     * @property int $id The unique identifier for the rating
     * @property int $user_id The identifier of the user who gave the rating
     * @property int $song_id The identifier of the song being rated
     * @property int $rate The rating value given to the song
     * @property \App\Models\User $user The user who gave the rating
     * @property \App\Models\Song $song The song being rated
     */

    /**
     * Get the user who gave this rating.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the song that was rated.
     */
    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class);
    }
}
