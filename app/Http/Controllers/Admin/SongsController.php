<?php

namespace App\Http\Controllers\admin;

use App\Models\Song;
use App\Models\Genre;
use App\Models\Performer;
use App\Models\Discography;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SongStorePostRequest;

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
        $disks = Discography::select("id", "name")->get();
        $genres = Genre::select("id", "title")->get();
        $performers = Performer::select("id", 'name')->get();

        return view("admin.songs.create", compact('disks', 'genres', 'performers'));
    }


    /**
     * Stores a new song in the database
     *
     * @param Request $request
     */
    public function store(SongStorePostRequest   $request)
    {
        Song::create($request->validated());

        return to_route("songs");
    }

    /**
     * Routing to the song edit display page
     *
     * @param int $id
     * @return View|RedirectResponse
     */
    public function edit($id): View|RedirectResponse
    {
        $song = Song::findOrFail($id);
        $genres = Genre::select("id", 'title')->get();
        $performers = Performer::select("id", 'name')->get();
        $disks = Discography::select("id", 'name')->get();

        return view("admin.songs.edit", compact('song', 'genres', 'performers', 'disks'));
    }


    /**
     * Updates the data of an existing song in the database
     *
     * @param Request $request
     * @param Song $song
     */
     public function update(SongStorePostRequest $request, Song $song)
    {
        $song->update($request->validated());
        return to_route("songs");
    }
    /**
     * Delete a song (softDelete)
     *
     * @param int $id
     */
    public function remove($id)
    {
        Song::findOrFail($id)->delete();
        return to_route("songs");
    }

    /**
     * Restores a deleted song
     *
     * @param int $id
     */
    public function restore($id)
    {
        Song::onlyTrashed()->findOrFail($id)->restore();
        return to_route("songs");
    }
}
