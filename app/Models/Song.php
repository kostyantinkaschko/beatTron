<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Traits\StoreTrait;

class Song extends Model
{
    use SoftDeletes, StoreTrait;
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
}
