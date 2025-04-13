<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use  Illuminate\Database\Eloquent\Factories\HasFactory;

class Song extends Model
{
    use SoftDeletes,
        HasFactory;
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
}
