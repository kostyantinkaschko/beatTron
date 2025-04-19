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
    public function index(Request $request)
    {
        $songs = Song::withTrashed()
            ->when($request->filled('genre_id'), fn($q) => $q->where('genre_id', $request->genre_id))
            ->when($request->filled('performer_id'), fn($q) => $q->where('performer_id', $request->performer_id))
            ->when($request->filled('name'), fn($q) => $q->where('name', 'like', '%' . $request->name . '%'))
            ->when($request->filled('year'), fn($q) => $q->where('year', $request->year))
            ->when($request->filled('status'), fn($q) => $q->where('status', 'like', '%' . $request->status . '%'))
            ->when($request->filled('created_at'), fn($q) => $q->whereDate('created_at', $request->created_at))
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $search = $request->search;
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('status', 'like', "%$search%")
                        ->orWhere('year', 'like', "%$search%");
                });
            })
            ->paginate(50);

        $genres = Genre::select('id', 'title')->get();
        $performers = Performer::select('id', 'name')->get();

        return view("admin.songs.songs", compact("songs", "genres", "performers"));
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
        $song = Song::create($request->validated());
        $song->song = $request->file('song')->store('songs', 'public');
        $song->addMedia($request->file('song'))
            ->toMediaCollection("songs");

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
