<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use  Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

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
        'disk_id',
        'performer_id',
        'name',
        'size',
        'rate',
        'listeningCount',
        'year',
        'status',
    ];
}
