<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performer extends Model
{

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
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
