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
        }, 1), 2);
    }


    /**
     * Format performer(s) data for API or view usage.
     *
     * @param mixed $data One or more Performer models
     * @param string $mode Either 'alone' for single or 'plural' for collection
     * @return array
     */
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
