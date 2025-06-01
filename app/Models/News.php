<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model implements HasMedia
{
    use SoftDeletes;
    use HasFactory;
    use InteractsWithMedia;
    protected $table = 'news';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'performer_id',
        'title',
        'text',
    ];

    /**
     * Represents a news article associated with a performer.
     *
     * This model stores information about news articles, including the performer who posted it,
     * the title, and the content of the article. It supports soft deletes and media file handling.
     *
     * @property int $id                              Unique identifier for the news article
     * @property int $performer_id                    ID of the performer who created the article
     * @property string $title                        Title of the news article
     * @property string $text                         Full text of the news article
     * @property \Illuminate\Support\Carbon|null $deleted_at Soft delete timestamp
     * @property \App\Models\Performer $performer     The performer who created the news article
     */


    /**
     * Get the performer who created this news article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function performer()
    {
        return $this->hasMany(Performer::class);
    }
}
