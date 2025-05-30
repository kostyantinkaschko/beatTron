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
use App\Traits\PerformerTrait;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    use SongTrait;
    use PerformerTrait;

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
        $songs = $this->processSongs(Song::with('playlists')->where("status", "=", "public")->take(10)->get());
        foreach ($songs as $song) {
            $song->listening = $this->pluralizeListeningCount($song->listening_count);
        }
        $performers = Performer::withTrashed()->take(37)->get();
        $news = News::withTrashed()->take(12)->get();

        foreach ($performers as $performer) {
            $performer->rate = $this->getPerfromerRate($performer);
        }
        $playlists = collect([]);
        if (Auth::check()) {
            $playlists = Playlist::where("user_id", "=", Auth::user()->id)->get();
        }

        return view("site.general", compact("songs", "news", "performers", "playlists"));
    }
}
