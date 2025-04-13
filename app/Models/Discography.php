<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Performer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Discography extends Model
{
    use SoftDeletes;
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
}
