<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medal extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'medals';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'description',
        'difficulty',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_medals');
    }
    public function userAdd()
    {
        return $this->belongsToMany(User::class, 'users_medals')->withPivot('id');
    }

}
