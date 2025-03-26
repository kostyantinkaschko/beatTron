<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Performer;
use App\Models\Song;

class SongsController extends Controller
{
    public function index()
    {
        $songs = Song::getSongs();

        return view("admin.songs.songs", compact("songs"));
    }

    public function create(): View
    {
        $songs = Song::getSongs();

        return view('admin.songs.create', compact("songs"));
    }

    public function store(Request $request)
    {
        $songData = [
            'genre_id' => $request->post('genre_id'),
            'performer_id' => $request->post('performer_id'),
            'name' => $request->post('name'),
            'year' => $request->post('year'),
            'status' => $request->post('status'),
            'disk_id' => $request->post('disk_id'),
            'created_at' => now(),
            "updated_at" => now(),
        ];
        Song::store($songData);

        return to_route("songs");
    }
}
