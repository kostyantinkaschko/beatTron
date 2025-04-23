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

    /**
     * Represents a music genre.
     * This model stores information about different music genres, such as their title, description, and year of origin.
     * It also allows retrieving the associated discographies related to this genre.
     *
     * @property int $id The unique identifier for the genre
     * @property string $title The title or name of the genre
     * @property string|null $description A description of the genre
     * @property int|null $year The year associated with the genre
     * @property \Illuminate\Database\Eloquent\Collection|Discography[] $discographies The discographies associated with this genre
     */

    public function discographies()
    {
        return $this->hasMany(Discography::class);
    }
}
