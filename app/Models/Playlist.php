<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StoreTrait;

class Playlist extends Model
{
    use SoftDeletes, StoreTrait;
    protected $table = 'playlists';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'author_id',
        'duration',
        'creationData'
    ];
}
