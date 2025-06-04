<?php

namespace App\Http\Controllers\Site;

use App\Models\Playlist;
use App\Traits\SongTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    use SongTrait;
    /**
     * Displays a page with a list of playlists belonging to the authenticated user.
     * Redirects to the login page if the user is not authenticated.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function site()
    {
        if (Auth::check()) {
            $playlists = Playlist::where("user_id", "=",  Auth::id())->paginate(20);
            return view("site.playlists.playlists", compact("playlists"));
        } else {
            return redirect("login");
        }
    }

    /**
     * Creates a new playlist for the authenticated user.
     * Redirects to the playlists page after creation.
     *
     */

    public function create()
    {
        Playlist::create(
            [
                'user_id' =>  Auth::id(),
                'name' => "New playlist"
            ]
        );

        return to_route("playlists");
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
            if ($playlist->user_id ==  Auth::id()) {
                $songs = $this->processSongs($playlist->songs);

                $playlists = collect([]);
                if (Auth::check()) {
                    $playlists = Playlist::where("user_id", "=",  Auth::id())->get();
                }

                return view("site.playlists.playlist", compact("playlist", "songs", "playlists"));
            } else {
                return redirect("playlists");
            }
        } else {
            return redirect("login");
        }
    }


    /**
     * Soft deletes the specified playlist.
     *
     * @param int $id The ID of the genre to delete.
     * @return \Illuminate\Http\RedirectResponse Redirects to the playlist listing page.
     */
    public function remove($id)
    {
        Playlist::findOrFail($id)->delete();

        return to_route("playlists");
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
            $playlist = Playlist::create(['user_id' =>  Auth::id()]);
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

    public function edit($id)
    {
        $playlist = Playlist::find($id);

        return response()->json($playlist);
    }

    public function update(Request $request, $id)
    {
        $playlist = Playlist::find($id);

        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $playlist->name = $request->name;
        $playlist->save();

        return response()->json($playlist);
    }
}
