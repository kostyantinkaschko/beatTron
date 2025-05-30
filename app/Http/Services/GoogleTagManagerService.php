<?php

namespace App\Http\Services;

use App\Models\Song;
use App\Models\Performer;

class GoogleTagManagerService
{

    public function viewSongPage(Song $song)
    {
        return [
            'event' => 'view_song',
            'item_id' => $song->id,
            'item_name' => $song->name,
            'genre_id' => $song->genre_id,
            'performer_id' => $song->performer_id,
            'disk_id' => $song->disk_id,
            'listening_count' => $song->listening_count,
            'year' => $song->year,
            'status' => $song->status,
        ];
    }

     public function viewPerformerPage(Performer $performer)
    {
        return [
            'event' => 'view_performer',
            'item_id' => $performer->id,
            'item_name' => $performer->name,
            'instagram' => $performer->instagram,
            'facebook' => $performer->facebook,
            'x' => $performer->x,
            'youtube' => $performer->youtube
        ];
    }
}
