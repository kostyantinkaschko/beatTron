<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Playlist extends Model
{
    protected $table = 'playlists';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'author_id',
        'duration',
        'creationData'
    ];

    public static function getPlaylists()
    {
        return DB::table("playlists")->get();
    }

}
