<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Genre extends Model
{
    protected $table = 'medals';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'title',
        'description',
    ];

    public static function getGenres()
    {
        return json_decode(DB::table("genres")->get(), true);
    }

    public static function store($data)
    {
        return DB::table("genres")->insert($data);
    }

    public static function deleteGenre()
    {
        return DB::table("genres")->delete($_GET['id']);
    }

    public static function getGenre()
    {
        $genre = DB::table("genres")->where("id", $_GET["id"])->get();
        return  $genre = [
            'title' => $genre->first()->title,
            'description' => $genre->first()->description,
        ];
    }

    public static function updateGenre($genre)
    {
        return DB::table('genres')
            ->where('id', $genre["id"])
            ->update([
                'title' => $genre["title"],
                'description' => $genre["description"],
                'updated_at' => now()
            ]);
    }
}
