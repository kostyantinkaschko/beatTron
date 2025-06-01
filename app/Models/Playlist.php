<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Playlist extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'playlists';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
    ];

    /**
     * Represents a playlist that a user can create and populate with songs.
     *
     * This model stores the playlist details and defines a many-to-many relationship to the songs
     * added to the playlist via the `playlists_songs` pivot table.
     *
     * @property int $id Unique identifier for the playlist
     * @property int $user_id ID of the user who owns the playlist
     *
     * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Song[] $songs Songs in the playlist
     */

    /**
     * Get the songs in the playlist (basic relation).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function songs()
    {
        return $this->belongsToMany(Song::class, 'playlists_songs');
    }


    /**
     * Get the songs in the playlist including pivot data.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function songsAdd()
    {
        return $this->belongsToMany(Song::class, 'playlists_songs')->withPivot('id');
    }
}
