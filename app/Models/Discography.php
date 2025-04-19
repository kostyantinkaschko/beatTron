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
