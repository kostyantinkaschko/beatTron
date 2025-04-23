<?php

namespace App\Http\Controllers\Site;

use App\Models\Playlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{

    /**
     * Displays a page with a list of playlists belonging to the authenticated user.
     * Redirects to the login page if the user is not authenticated.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function site()
    {
        if (Auth::check()) {
            $playlists = Playlist::where("user_id", "=", Auth::user()->id)->paginate(20);
            return view("site.playlists.playlists", compact("playlists"));
        } else {
            return redirect("login");
        }
    }

    /**
     * Creates a new playlist for the authenticated user.
     * Redirects to the playlists page after creation.
     *
     * @return \Illuminate\View\View
     */

    public function create()
    {
        Playlist::create(['user_id' => Auth::user()->id]);

        return view("site.playlists.playlists");
    }


    /**
     * Displays a page with details of a specific playlist and its songs.
     * Only shows the playlist if it belongs to the authenticated user.
     * Retrieves and processes song file details (e.g., duration).
     *
     * @param  int  $id  The ID of the playlist
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function playlist($id)
    {

        if (Auth::check()) {

            $playlist = Playlist::find($id);
            if ($playlist->user_id == Auth::user()->id) {
                $songs = $playlist->songs;

                $getID3 = new \getID3;
                $extensions = ["mp3", "wav", "flac"];
                $projectPath = str_replace("\public", '/', public_path());
                $basePath = $projectPath . 'resources/songs/';

                foreach ($songs as $song) {
                    $found = false;

                    foreach ($extensions as $ext) {
                        $filePath = $basePath . $song->id . '.' . $ext;
                        if (file_exists($filePath)) {
                            $song->extension = $ext;
                            $song->filePath = $filePath;
                            $found = true;
                            break;
                        }
                    }

                    if ($found && file_exists($song->filePath)) {
                        $info = $getID3->analyze($song->filePath);
                        $song->duration = $info['playtime_string'] ?? null;
                    } else {
                        $song->duration = null;
                    }
                }
                return view("site.playlists.playlist", compact("playlist", "songs"));
            } else {
                return redirect("playlists");
            }
        } else {
            return redirect("login");
        }
    }
     /**
     * Adds a song to a playlist. If the playlist doesn't exist, it creates a new one.
     * Checks if the song is already in the playlist to prevent duplicates.
     *
     * @param  \Illuminate\Http\Request  $request  The request containing the playlist and song data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addSong(Request $request)
    {
        if ($request->post("playlist") == "create") {
            $playlist = Playlist::create(['user_id' => Auth::user()->id]);
            $playlist = Playlist::find($playlist->id);
        } else {
            $playlist = Playlist::find($request->post("playlist"));
        }
        $songId = $request->post("song");

        if ($playlist->songsAdd()->where('song_id', $songId)->exists()) {
            return redirect()->back();
        }

        $playlist->songsAdd()->attach($songId);
        return redirect()->back();
    }
}
