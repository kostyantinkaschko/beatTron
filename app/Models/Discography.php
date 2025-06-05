<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Performer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Discography extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;
    protected $table = 'discography';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'genre_id',
        'performer_id',
        'name',
        'type',
        'description',
        'status'
    ];

    /**
     * Represents a discography entry for a performer.
     *
     * This model stores information about albums, EPs, or singles in a performer's catalog.
     * It includes relationships to performers, genres, and songs.
     * It supports media management through Spatie Media Library and soft deletes.
     *
     * @property int $id                     Unique identifier for the discography entry.
     * @property int $genre_id              ID of the genre associated with the discography entry.
     * @property int $performer_id          ID of the performer associated with the discography entry.
     * @property string $name               Name of the discography entry.
     * @property string $type               Type of the discography (e.g., album, single, EP).
     * @property string|null $description   Optional description.
     * @property \App\Models\Genre $genre   The genre relationship.
     * @property \App\Models\Performer $performer The performer relationship.
     * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Song[] $songs Songs related to this discography entry.
     */

    /**
     * Get the performer who owns this discography.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function performer(): BelongsTo
    {
        return $this->belongsTo(Performer::class);
    }

    /**
     * Get the genre associated with this discography.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
    /**
     * Get all songs belonging to this discography.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function songs()
    {
        return $this->hasMany(Song::class, 'disk_id');
    }
    
    /**
     * Get the directory path where media files for this discography are stored.
     *
     * @return string
     */
    public function getMediaDirectory(): string
    {
        return 'disks/' . $this->id;
    }
}
