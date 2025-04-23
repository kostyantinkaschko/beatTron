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
use App\Traits\PerformerRateTrait;
use Illuminate\Support\Facades\Auth;


class GeneralController extends Controller
{
    
    use SongTrait, PerformerRateTrait;

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
        $songs = $this->processSongs(Song::where("status", "=", "public")->take(10)->get());
        $performers = Performer::withTrashed()->take(10)->get();
        $performersView = Performer::select('id', 'name')->withTrashed()->get();
        $news = News::withTrashed()->take(12)->get();

        foreach($performers as $performer){
            $performer->rate = $this->getPerfromerRate($performer);
        }

        if (Auth::check()) {
            $playlists = Playlist::where("user_id", "=", Auth::user()->id)->get();
        }

        return view("site.general", compact("songs", "news", "performers", "performersView") + (isset($playlists) ? ['playlists' => $playlists] : []));
    }
}
