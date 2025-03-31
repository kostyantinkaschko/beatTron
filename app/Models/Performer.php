<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StoreTrait;
class Performer extends Model
{
    use SoftDeletes, StoreTrait;
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

}
