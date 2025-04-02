<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Song;

class SongsController extends Controller
{
    /**
     * Routing to the songs display page
     *
     * @return View
     */
    public function index()
    {
        $songs = Song::withTrashed()->get();

        return view("admin.songs.songs", compact("songs"));
    }

    /**
     * Routing to the song creation display page
     *
     * @return View
     */
    public function create(): View
    {
        return view("admin.songs.create");
    }


 /**
     * Stores a new song in the database
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        Song::store([
            'genre_id' => $request->post('genre_id'),
            'performer_id' => $request->post('performer_id'),
            'name' => $request->post('name'),
            'year' => $request->post('year'),
            'status' => $request->post('status'),
            'disk_id' => $request->post('disk_id'),
            'created_at' => now(),
            "updated_at" => now(),
        ]);
        return to_route("songs");
    }

      /**
     * Routing to the song edit display page
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $song = Song::find($id);

        return view("admin.songs.edit", compact('song'));
    }


    /**
     * Updates the data of an existing song in the database
     *
     * @param Request $request
     * @param Song $song
     */
    public function update(Request $request, Song $song)
    {
        $song->update([
            'genre_id' => $request->post('genre_id'),
            'performer_id' => $request->post('performer_id'),
            'name' => $request->post('name'),
            'year' => $request->post('year'),
            'status' => $request->post('status'),
            'disk_id' => $request->post('disk_id'),
            'created_at' => now(),
            "updated_at" => now(),
        ]);
        return to_route("songs");
    }
      /**
     * Delete a song (mild delete)
     *
     * @param int $id
     */
    public function remove($id)
    {
        $song = Song::findOrFail($id);
        $song->delete();
        return to_route("songs");
    }

    /**
     * Restores a deleted song
     *
     * @param int $id
     */
    public function restore($id)
    {
        $song = Song::onlyTrashed()->findOrFail($id);
        $song->restore();
        return to_route("songs");
    }
}
