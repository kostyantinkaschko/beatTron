<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Song;

class SongsController extends Controller
{
    public function index()
    {
        $songs = Song::withTrashed()->get();

        return view("admin.songs.songs", compact("songs"));
    }

    public function create(): View
    {
        return view("admin.songs.create");
    }



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

    public function edit($id)
    {
        $song = Song::find($id);

        return view("admin.songs.edit", compact('song'));
    }

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
    public function remove($id)
    {
        $song = Song::findOrFail($id);
        $song->delete();
        return to_route("songs");
    }
    public function restore($id)
    {
        $song = Song::onlyTrashed()->findOrFail($id);
        $song->restore();
        return to_route("songs");
    }
}
