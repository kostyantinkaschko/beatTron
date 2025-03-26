<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Discrography extends Model
{
    protected $table = 'discography';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'genre_id',
        'type',
        'title',
        'author',
        'description',
        'duration',
    ];

    public static function getDisks()
    {
        return json_decode(json_encode(DB::table("discography")->get()));
    }

    public static function store($data)
    {
        return DB::table("discography")->insert($data);
    }

    public static function deleteDisc()
    {
        return DB::table("discography")->delete($_GET['id']);
    }

    public static function getDisk()
    {
        $disk = DB::table("discography")->where("id", $_GET["id"])->get();
        return  $disk = [
            'id' => $_GET["id"],
            'genre_id' => $disk->first()->genre_id,
            'author' => $disk->first()->author,
            'type' => $disk->first()->type,
            'description' => $disk->first()->description,
            'duration' => $disk->first()->duration,
            'updated_at' => now(),
        ];
    }

    public static function updateDisk($disk)
    {
        return DB::table('discography')
            ->where('id', $disk["id"])
            ->update([
                'genre_id' => $disk->first()->title,
                'author' => $disk->first()->author,
                'type' => $disk->first()->type,
                'description' => $disk->first()->description,
                'duration' => $disk->first()->duration,
                'updated_at' => now(),
            ]);
    }
}
