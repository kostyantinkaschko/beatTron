<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'id';
  /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'performer_id',
        'title',
        'text',
        'author',
    ];

    public static function getNews()
    {
        return DB::table("news")->get();
    }
}
