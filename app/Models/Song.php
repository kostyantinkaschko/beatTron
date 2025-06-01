<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * This model contains information about a song's genre, performer, album (disk), and additional metadata.
     *
     * @property int $id
     * @property int $genre_id
     * @property int $performer_id
     * @property int $disk_id
     * @property string $name
     * @property int $listening_count
     * @property int $year
     * @property string $status
     * @property \App\Models\Performer $performer
     * @property \App\Models\Genre $genre
     * @property \App\Models\Discography $disk
     * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Playlist[] $playlists
     * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Rating[] $ratings
     */

    /**
     * Performer who created the song.
     */
    public function performer(): BelongsTo
    {
        return $this->belongsTo(Performer::class);
    }

    /**
     * Genre of the song.
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    /**
     * Album (Discography) the song belongs to.
     */
    public function disk(): BelongsTo
    {
        return $this->belongsTo(Discography::class, 'disk_id');
    }

    /**
     * Playlists that include this song.
     */
    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class, 'playlists_songs');
    }

    /**
     * Playlists with pivot data.
     */
    public function playlistsAdd(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class, 'playlists_songs')->withPivot('id');
    }

    /**
     * Ratings given to this song.
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
}
