<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    use SoftDeletes;
    use HasFactory;
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
     *
     * This model stores information about different music genres, such as their title, description, and year of origin.
     * It also defines a relationship to discographies that belong to this genre.
     *
     * @property int $id                                  Unique identifier for the genre.
     * @property string $title                            Name of the genre.
     * @property string|null $description                 Optional description of the genre.
     * @property int|null $year                           Optional year the genre originated.
     * @property \Illuminate\Support\Carbon|null $deleted_at Date/time when the genre was soft-deleted (if applicable).
     * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Discography[] $discographies List of associated discographies.
     */

    /**
     * Get all discographies associated with this genre.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discographies()
    {
        return $this->hasMany(Discography::class);
    }
}
