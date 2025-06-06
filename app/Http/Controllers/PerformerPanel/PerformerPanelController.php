<?php

namespace App\Http\Controllers\PerformerPanel;

use App\Models\News;
use App\Models\Song;
use App\Models\User;
use App\Models\Genre;
use App\Models\Playlist;
use App\Models\Performer;
use App\Models\Discography;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\PerformersStorePostRequest;
use App\Http\Requests\DiscographyStorePostRequest;

class PerformerPanelController extends Controller
{

    /**
     * Displays a page with detailed information about a specific performer, including their discographies, news, and songs.
     * Also fetches and processes song file details (e.g., duration).
     *
     * @param  int  $id  The ID of the performer
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $performer = Performer::with(["discographies", "news", "songs"])->where('user_id', Auth::id())->first();
        $getID3 = new \getID3();
        $extensions = ["mp3", "wav", "flac"];
        $projectPath = str_replace("\public", '/', public_path());
        $basePath = $projectPath . 'resources/songs/';

        $songs = Song::where("performer_id", $performer->id)->inRandomOrder()->take(15)->get();
        $performerPage = true;

        $validateSong = function ($song) use ($extensions, $basePath, $getID3) {
            foreach ($extensions as $ext) {
                $filePath = $basePath . $song->id . '.' . $ext;
                if (file_exists($filePath)) {
                    $song->extension = $ext;
                    $song->filePath = $filePath;
                    $info = $getID3->analyze($filePath);
                    $song->duration = $info['playtime_string'] ?? null;
                    return $song;
                }
            }
            $song->duration = null;
            return $song;
        };

        foreach ($songs as $song) {
            $validateSong($song);
        }

        $playlists = collect([]);
        if (Auth::check()) {
            $playlists = Playlist::where("user_id", Auth::id())->get();
        }
        $news = News::where("performer_id", "=", Auth::user()->performer->id)->take(5)->get();


        return view("performerPanel.panel", compact("performer", "performerPage", "playlists", "songs", "news"));
    }


    /**
     * Displays the edit page for a specific performer.
     * Allows the performer to update their profile details.
     *
     * @param  int  $id  The ID of the performer to edit
     * @return \Illuminate\View\View
     */
    public function performerEdit()
    {
        $performer = Performer::find(Auth::user()->performer->id);

        return view("performerPanel.performerEdit", compact("performer"));
    }

    /**
     * Updates the data of an existing performer in the database.
     * This action is triggered when the performer submits their profile updates.
     *
     * @param  \App\Http\Requests\PerformersStorePostRequest  $request  The validated request data
     * @param  \App\Models\Performer  $performer  The performer to be updated
     * @return \Illuminate\Http\RedirectResponse
     */
    public function performerUpdate(PerformersStorePostRequest $request, Performer $performer)
    {
        // dd($performer);
        $performer->update($request->validated());

        return to_route("performerPage", $performer->id);
    }
}
