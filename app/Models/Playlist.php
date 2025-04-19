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

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'playlists_songs');
    }

    public function songsAdd()
    {
        return $this->belongsToMany(Song::class, 'playlists_songs')->withPivot('id');
    }
}
