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
     * Display the homepage of the site.
     *
     * Loads the latest public songs, recent news, and performers (including soft-deleted).
     * Processes songs to include duration and human-readable listening count.
     * Calculates performer ratings using a custom trait.
     * If the user is authenticated, their playlists are also retrieved.
     *
     * @return View
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
            $performer->rate = $this->getPerformerRate($performer);
        }
        $playlists = collect([]);
        if (Auth::check()) {
            $playlists = Playlist::where("user_id", "=",  Auth::id())->get();
        }

        return view("site.general", compact("songs", "news", "performers", "playlists"));
    }
}
