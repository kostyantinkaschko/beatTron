<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StoreTrait;

class Discrography extends Model
{
    use SoftDeletes, StoreTrait;
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

}
