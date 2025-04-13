<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Performer;
use App\Models\Playlist;
use Illuminate\Support\Facades\Auth;


class GeneralController extends Controller
{

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
        $songs = Song::withTrashed()->get();
        $news = News::withTrashed()->get();
        $performers = Performer::withTrashed()->get();
        $performersView = Performer::select('id', 'name')->withTrashed()->get();
        $playlists = Playlist::where("user_id", "=", Auth::user()->id)->get();
        
        

        $getID3 = new \getID3;
        foreach ($songs as $song) {
            $extensions = ["mp3", "wav", "flac"];

            foreach ($extensions as $extension) {
                $song->extension = $extension;
                $projectPath = str_replace("\public", '/',public_path());  
                $path = $projectPath . 'resources/songs/';
                
                if (file_exists( $path . $song->id . "." . $song->extension)) {
                    break;
                }
            }
            if (!file_exists($path . $song->id . '.' . $song->extension)) {
                continue;
            }

            $song->filePath = $path . $song->id . "." . $song->extension;
            
            if (file_exists($song->filePath)) {
                $info = $getID3->analyze($song->filePath); 
                $song->duration = $info['playtime_string'];
            } else {
                $songs[$song->id] = null;
            }
        }

        return view("site.general", compact("songs", "news", "performers", 'performersView', "playlists"));
    }
}
