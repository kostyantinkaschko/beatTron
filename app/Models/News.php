<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StoreTrait;
class News extends Model
{
    use SoftDeletes, StoreTrait;
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

    }
