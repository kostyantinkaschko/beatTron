<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes, HasFactory;
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
     * This model stores information about news articles, including the performer who posted it, the title, and the content of the article.
     * It also defines the relationship to the performer who created the article.
     *
     * @property int $id The unique identifier for the news article
     * @property int $performer_id The identifier of the performer who posted the news
     * @property string $title The title of the news article
     * @property string $text The content of the news article
     * @property \Illuminate\Database\Eloquent\Collection|Performer[] $performer The performer who created the article
     */


    public function performer()
    {
        return $this->hasMany(Performer::class);
    }
}
