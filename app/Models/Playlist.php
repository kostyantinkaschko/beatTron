<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Playlist extends Model
{
    use SoftDeletes, HasFactory;
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
     * This model stores the playlist details and defines relationships to the songs
     * added to the playlist.
     *
     * @property int $id The unique identifier for the playlist
     * @property int $user_id The identifier of the user who owns the playlist
     * @property \Illuminate\Database\Eloquent\Collection|Song[] $songs The songs in the playlist
     * @property \Illuminate\Database\Eloquent\Collection|Song[] $songsAdd The songs in the playlist with pivot data (e.g., additional information)
     */


    public function songs()
    {
        return $this->belongsToMany(Song::class, 'playlists_songs');
    }

    public function songsAdd()
    {
        return $this->belongsToMany(Song::class, 'playlists_songs')->withPivot('id');
    }
}
