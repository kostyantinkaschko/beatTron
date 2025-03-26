<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Song extends Model
{
    protected $table = 'songs';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'genre_id',
        'performerId',
        'name',
        'size',
        'rate',
        'duration',
        'listeningCount',
        'year',
        'status',
        'creationDate',
    ];

    public static function getSongs()
    {
        return json_decode(DB::table("songs")->get(), true);
    }


    public static function getSongsByGenre($genre)
    {
        return DB::table("songs")->where("genre_id", $genre)->get();
    }

    public static function store($data)
    {
        return DB::table("songs")->insert($data);
    }



}
