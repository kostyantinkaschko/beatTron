<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Medal extends Model
{
    protected $table = 'medals';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'description',
        'difficult',
    ];

    public static function getMedals()
    {
        return json_decode(json_encode(DB::table("medals")->get()), true);
    }

    public static function getMedal()
    {
        $medal = DB::table("medals")->where("id", $_GET["id"])->get();
        return  $medal = [
            'id' => $medal->first()->id,
            'name' => $medal->first()->name,
            'type' => $medal->first()->type,
            'description' => $medal->first()->description,
            'difficult' => $medal->first()->difficult,
        ];
    }

    public static function updateMedal($medal)
    {
        return DB::table('medals')
            ->where('id', $medal["id"])
            ->update([
                'name' => $medal["name"],
                'type' => $medal['type'],
                'description' => $medal['description'],
                'difficult' => $medal['difficult'],
            ]);
    }


    public static function store($data)
    {
        return DB::table("medals")->insert($data);
    }
}
