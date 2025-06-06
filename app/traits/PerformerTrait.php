<?php

namespace App\Traits;

use App\Models\Song;
use App\Models\User;
use App\Models\Rating;
use App\Models\Performer;

trait PerformerTrait
{
    /**
     * Calculate and return the compounded rating for the given performer.
     * Multiplicative method is sensitive to zeroes.
     *
     * @param \App\Models\Performer $performer
     * @return float
     */
    public function getPerformerRate($performer)
    {
        $songs = Song::where("performer_id", $performer->id)->pluck('id');
        $songRating = Rating::whereIn('song_id', $songs)->pluck('rate');

        return round($songRating->reduce(function ($carry, $item) {
            return $carry * $item;
        }, 0), 2);
    }
}
