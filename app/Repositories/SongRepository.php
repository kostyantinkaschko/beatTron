<?php

namespace App\Repositories;

use App\Models\Song;
use App\Traits\SongTrait;
use App\Http\Resources\SongResource;
use App\Http\Requests\SongStorePostRequest;
use App\Http\Requests\SongStorePostApiRequest;

class SongRepository
{
    use SongTrait;
    public function all()
    {
        return  $this->processSongs(Song::where("status", "=", "public")->get());
    }

    public function find($id)
    {

        $song = Song::where("status", "=", "public")->find($id);

        $this->processSongs($song, "alone");
        $this->songFormatting($song, "alone");

        return $song;
    }

    public function create($data)
    {
        $song = Song::create($data);

        $song->addMedia($data['file'])
            ->toMediaCollection('songs');

        return new SongResource($song);
    }

    public function update(array $data, int $id)
    {
        $song = Song::findOrFail($id);
        $song->update($data);
        return $song;
    }


    public function delete($id)
    {
        return Song::find($id)->delete();
    }
}
