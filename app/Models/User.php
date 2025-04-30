<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Performer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

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
     * Represents a user in the system, extending the Authenticatable model for user authentication.
     * This model includes the user's basic information, authentication details, and relationships with medals and performers.
     *
     * @property int $id The unique identifier for the user
     * @property string $name The first name of the user
     * @property string $surname The surname of the user
     * @property string $email The email address of the user
     * @property string $password The hashed password of the user
     * @property string $phone The phone number of the user
     * @property \Illuminate\Database\Eloquent\Relations\HasOne $performer The performer associated with the user (if any)
     */


    public function performer()
    {
        return $this->hasOne(Performer::class);
    }

    public static function performerId()
    {
        return Performer::select("id")->where('user_id', '=', Auth::id())->value('id');
    }

    // public function medals()
    // {
    //     return $this->belongsToMany(Medal::class, 'users_medals');
    // }


    // public function medalsAdd()
    // {
    //     return $this->belongsToMany(Medal::class, 'users_medals')->withPivot('id');
    // }
}
