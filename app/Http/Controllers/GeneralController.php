<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Song;
use App\Traits\SongTrait;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Performer;
use App\Models\Playlist;
use Illuminate\Support\Facades\Auth;


class GeneralController extends Controller
{
    
    use SongTrait;

    /**
     * Displays the main page of the site with a list of songs, news, and performers.
     *
     * Retrieves all songs, news, and performers, including soft-deleted ones.
     * For each song, checks for the existence of an audio file with supported extensions (mp3, wav, flac),
     * and uses getID3 to analyze the file and extract its duration if the file exists.
     *
     * @return \Illuminate\Contracts\View\View
     */

    public function index()
    {
        $songs = $this->processSongs(Song::withTrashed()->take(10)->get());
        
        $news = News::withTrashed()->take(12)->get();
        $performers = Performer::withTrashed()->take(10)->get();
        $performersView = Performer::select('id', 'name')->withTrashed()->get();

        if (Auth::check()) {
            $playlists = Playlist::where("user_id", "=", Auth::user()->id)->get();
        }

        return view("site.general", compact("songs", "news", "performers", "performersView") + (isset($playlists) ? ['playlists' => $playlists] : []));
    }
}
