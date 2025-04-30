<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medal extends Model
{
    use SoftDeletes;
    use HasFactory;
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

    /**
     * Represents a medal awarded to users.
     * This model stores information about various medals, including their name, type, description, and difficulty level.
     * It also defines relationships to users who have earned these medals.
     *
     * @property int $id The unique identifier for the medal
     * @property string $name The name of the medal
     * @property string $type The type or category of the medal
     * @property string|null $description A description of the medal
     * @property string|null $difficulty The difficulty level required to earn the medal
     * @property \Illuminate\Database\Eloquent\Collection|User[] $users The users who have earned this medal
     */


    public function users()
    {
        return $this->belongsToMany(User::class, 'users_medals');
    }
    public function userAdd()
    {
        return $this->belongsToMany(User::class, 'users_medals')->withPivot('id');
    }
}
