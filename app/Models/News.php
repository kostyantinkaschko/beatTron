<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
  /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'performer_id',
        'title',
        'text',
        'author',
    ];
}
