<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discrography extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'genre_id',
        'type',
        'title',
        'author',
        'description',
        'duration',
    ];
}
