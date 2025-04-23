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

    use SoftDeletes, InteractsWithMedia, HasFactory;
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
    ];

    /**
     * Represents a discography entry for a performer.
     * This model stores information about albums, EPs, or singles in the performer’s catalog, including associated metadata like genre, type, and description.
     * It also supports media file handling, such as images or other media related to the discography, and allows for soft deleting.
     *
     * @property int $id The unique identifier for the discography entry
     * @property int $genre_id The ID of the genre associated with this discography entry
     * @property int $performer_id The ID of the performer associated with this discography entry
     * @property string $name The name of the discography entry
     * @property string $type The type of the discography entry (e.g., album, single, EP)
     * @property string $description A description of the discography entry
     * @property \Illuminate\Database\Eloquent\Collection|Song[] $songs The songs associated with this discography entry
     * @property \App\Models\Genre $genre The genre associated with this discography entry
     * @property \App\Models\Performer $performer The performer associated with this discography entry
     */


    public function performer(): BelongsTo
    {
        return $this->belongsTo(Performer::class);
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
    public function songs()
    {
        return $this->hasMany(Song::class, 'disk_id');
    }

    public function getMediaDirectory(): string
    {
        return 'disks/' . $this->id;
    }
}
