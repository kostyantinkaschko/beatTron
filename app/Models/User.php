<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'phone',
        // 'rank',
        // 'level',
        // 'exp',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Represents a user in the system.
     *
     * @property int $id
     * @property string $name
     * @property string $surname
     * @property string $email
     * @property string $phone
     * @property string $password
     * @property \App\Models\Performer|null $performer
     */

    /**
     * One-to-one relationship with Performer.
     */
    public function performer(): HasOne
    {
        return $this->hasOne(Performer::class);
    }

    /**
     * Get the ID of the performer linked to the authenticated user.
     *
     * @return int|null
     */
    public static function performerId(): ?int
    {
        return Performer::where('user_id', Auth::id())->value('id');
    }


    /*
    public function medals(): BelongsToMany
    {
        return $this->belongsToMany(Medal::class, 'users_medals');
    }

    public function medalsAdd(): BelongsToMany
    {
        return $this->belongsToMany(Medal::class, 'users_medals')->withPivot('id');
    }
    */
}
