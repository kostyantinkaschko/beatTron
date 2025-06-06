<?php

namespace App\Http\Controllers\Site;

use App\Models\Song;
use App\Models\Playlist;
use App\Traits\SongTrait;
use App\Models\Discography;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DiscographyController extends Controller
{
    use SongTrait;

    /**
     * Display a paginated list of all discs (including soft-deleted).
     *
     * @return View
     */
    public function index(): View
    {
        $disks = Discography::where('status', '=', 'public')->withTrashed()->paginate(50);

        return view("site.discography.discography", compact("disks"));
    }

    /**
     * Display a single disc page, including performer, genre, and songs.
     * Shows latest songs and playlists if user is authenticated.
     *
     * @param  int  $id  The ID of the disc to display
     * @return View
     */
    public function disk(int $id): View
    {
        $disk = Discography::with(["performer", "genre", "songs"])->find($id);

        $songs = $this->processSongs(
            Song::where("disk_id" , "=", $id)->get()
        );

        $playlists = [];
        if (Auth::check()) {
            $playlists = Playlist::where("user_id", Auth::id())->get();
        }
        // dd($disk);
        return view("site.discography.disk", compact("disk", "songs", "playlists"));
    }
}
