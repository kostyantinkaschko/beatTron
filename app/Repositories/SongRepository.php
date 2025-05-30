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

     /**
     * @OA\Get(
     *     path="/api/v1/song/{id}",
     *     tags={"Songs"},
     *     summary="Get one song",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Song id",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="One song",
     *         @OA\JsonContent(ref="#/components/schemas/SongResource")
     *     ),
     *     @OA\Response(response=404, description="Not found")
     * 
     * )
     */

    public function find($id)
    {
        $songs = $this->processSongs(Song::where("status", "=", "public")->find($id), "alone");
        return $this->songFormatting($songs, "alone");
    }

    public function create(array $data)
    {
        return Song::create($data);
    }

    public function update($data, $id) // SongStorePostApiRequest $request
    {
        $Song = Song::find($id);
        if ($Song) {
            $Song->update($data);
        }
        return $Song;
    }

    public function delete($id)
    {
        return Song::find($id)->delete();
    }
}
