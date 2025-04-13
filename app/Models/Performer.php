<?php

namespace App\Models;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Performer extends Model
{
    use SoftDeletes;
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
        'instagram',
        'facebook',
        'x',
        'youtube',
    ];

    public function discographies() 
    {
        return $this->hasMany(Discography::class);
    }

    public function news() 
    {
        return $this->hasMany(News::class);
    }

    public function song() 
    {
        return $this->hasMany(Song::class);
    }
}
