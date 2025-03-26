<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Performer extends Model
{
    protected $table = 'performers';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'rate',
        'instagram',
        'facebook',
        'x',
        'youtube',
        'creationDate'
    ];

    public static function getPerformers()
    {
        return json_decode(DB::table("performers")->get(), true);
    }

    public static function deletePerformer()
    {
        return DB::table("performers")->delete($_GET['id']);
    }

    public static function getPerformer()
    {
        $performers = DB::table("performers")->get();
        return [
            'id' => $performers->first()->id,
            'user_id' => $performers->first()->user_id,
            'name' => $performers->first()->name,
            'instagram' => $performers->first()->instagram,
            'facebook' => $performers->first()->facebook,
            'youtube' => $performers->first()->youtube,
            'created_at' => $performers->first()->created_at,
            'updated_at' => $performers->first()->created_at,
        ];
    }

    public static function store($data)
    {
        return DB::table("performers")->insert($data);
    }

    public static function updatePerformer($performer)
    {
        return DB::table('performers')
            ->where('id', $performer["id"])
            ->update([
                'user_id' => $performer["user_id"],
                'name' => $performer["name"],
                'instagram' => $performer["instagram"],
                'facebook' => $performer["facebook"],
                'youtube' => $performer["youtube"],
                'updated_at' => now()
            ]);
    }
}
