<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use  Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    use SoftDeletes,
        HasFactory;
    protected $table = 'genres';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'year'
    ];
    public function discographies()
    {
        return $this->hasMany(Discography::class);
    }
}
