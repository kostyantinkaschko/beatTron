<?php

namespace App\Traits;

use App\Models\Song;
use App\Models\Rating;

trait PerformerRateTrait
{

    /**
     * Trait to calculate the rating of a performer based on the ratings of their songs.
     * 
     * This trait includes a method to retrieve all ratings for a performer's songs
     * and calculate a compounded rating using a multiplicative approach.
     * 
     * @method float getPerfromerRate($performer) Calculate and return the compounded rating for the given performer.
     * 
     * @param \App\Models\Performer $performer The performer whose ratings will be calculated.
     * 
     * @return float The compounded rating of the performer's songs.
     */

    public function getPerfromerRate($performer)
    {
        $songs = Song::where("performer_id", $performer->id)->pluck('id');
        $songRating = Rating::whereIn('song_id', $songs)->pluck('rate');

        return $songRating->reduce(function ($carry, $item) {
            return $carry * $item;
        }, 1);
    }
}
