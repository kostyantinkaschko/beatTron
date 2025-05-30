<?php

namespace App\Traits;

use App\Models\Song;
use App\Models\User;
use App\Models\Rating;
use App\Models\Performer;

trait PerformerTrait
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

     public function performerFormatting($data, $mode = "plural")
    {
        function writeData($item)
        {
            return  [
                'id' => $item->id,
                'user' => User::find($item->user_id)->name,
                "name" => $item->name,
                "instagram" => $item->year,
                "facebook" => $item->status,
                "x" => $item->year,
                "youtube" => $item->status,
                
            ];
        }

        if ($mode == "alone") {
            return writeData($data);
        } else if ($mode == "plural") {
            $result = [];
            foreach ($data as $item) {
                $result[] = writeData($item);
            }

            return $result;
        }
    }

}
