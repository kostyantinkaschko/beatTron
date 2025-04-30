<?php

namespace App\Http\Controllers\Site;

use App\Models\Song;
use App\Models\Playlist;
use App\Traits\SongTrait;
use App\Models\Discography;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DiscographyController extends Controller
{
    use SongTrait;

    /**
     * Displays a page with a list of discs.
     * Uses pagination to limit the number of discs on the page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $disks = Discography::withTrashed()->paginate(50);

        return view("site.discography.discography", compact("disks"));
    }


    /**
     * Displays a page with details of a specific disc, including information about the performer, genre, and songs.
     * Also shows the latest songs and user playlists if the user is authenticated.
     *
     * @param  int  $id  The ID of the disc
     * @return \Illuminate\View\View
     */
    public function disk($id)
    {
        $disk = Discography::with(["performer", "genre", "songs"])->find($id);
        $songs = $this->processSongs(Song::withTrashed()->take(10)->get());


        if (Auth::check()) {
            $playlists = Playlist::where("user_id", "=", Auth::user()->id)->get();
        }

        return view("site.discography.disk", compact("disk", "songs", "playlists"));
    }
}
