<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
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
