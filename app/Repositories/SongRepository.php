<?php

namespace App\Repositories;

use App\Models\Song;
use App\Traits\SongTrait;
use App\Http\Requests\SongStorePostRequest;
use App\Http\Requests\SongStorePostApiRequest;

class SongRepository
{
    use SongTrait;
    public function all()
    {
        $songs = $this->processSongs(Song::where("status", "=", "public")->get());
        return $this->songFormatting($songs, "plural");
    }

    public function find($id)
    {
        $songs = $this->processSongs(Song::where("status", "=", "public")->find($id), "alone");
        return $this->songFormatting($songs, "alone");
    }

    public function create(array $data)
    {
        return Song::create($data);
    }

    public function update($data, $id)
    {
        $song = Song::find($id);
        if ($song) {
            $song->update($data);
        }
        return $song;
    }

    public function delete($id)
    {
        return Song::find($id)->delete();
    }
}
