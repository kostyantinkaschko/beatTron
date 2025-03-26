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
        return DB::table("genres")->get();
    }

    public static function store($data)
    {
        return DB::table("genres")->insert($data);
    }

    public static function deleteGenre($id)
    {
        return DB::table("genres")->delete($id);
    }

    public static function getGenre($id)
    {
        return DB::table("genres")->find($id);
    }

    public static function updateGenre($genre, $id)
    {
        return DB::table('genres')
            ->where('id', $id)
            ->update([
                'title' => $genre["title"],
                'description' => $genre["description"],
                'updated_at' => now()
            ]);
    }
}
