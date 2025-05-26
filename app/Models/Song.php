<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Song extends Model implements HasMedia
{
    use SoftDeletes;
    use HasFactory;
    use InteractsWithMedia;
    protected $table = 'songs';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'genre_id',
        'performer_id',
        'disk_id',
        'name',
        'listening_count',
        'year',
        'status',
    ];

    /**
     * Represents a song in the system.
     * This model contains information about a song's genre, performer, album (disk), and additional metadata such as listening count, year, and status.
     * It also defines relationships to the performer, playlists, and media library.
     *
     * @property int $id The unique identifier for the song
     * @property int $genre_id The genre identifier of the song
     * @property int $performer_id The performer identifier of the song
     * @property int $disk_id The disk (album) identifier the song belongs to
     * @property string $name The name of the song
     * @property int $listening_count The number of times the song has been listened to
     * @property int $year The year the song was released
     * @property string $status The status of the song (e.g., 'public', 'private')
     * @property \Illuminate\Database\Eloquent\Relations\BelongsTo $performer The performer who created the song
     * @property \Illuminate\Database\Eloquent\Relations\BelongsToMany $playlists The playlists that the song is part of
     */


    public function performer()
    {
        return $this->belongsTo(Performer::class);
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlists_songs');
    }

    public function playlistsAdd()
    {
        return $this->belongsToMany(Playlist::class, 'playlists_songs')->withPivot('id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
