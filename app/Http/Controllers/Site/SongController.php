<?php

namespace App\Http\Controllers\Site;

use App\Models\Song;
use App\Models\Playlist;
use App\Traits\SongTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SongController extends Controller
{
    use SongTrait;

    /**
     * Increments the listening count of a specific song.
     * Returns an error if the song is not found.
     *
     * @param  \Illuminate\Http\Request  $request  The request object
     * @param  int  $id  The ID of the song
     * @return \Illuminate\Http\JsonResponse
     */

    public function incrementListeningCount(Request $request, $id)
    {
        $song = Song::find($id);
        if (!$song) {
            return response()->json(['error' => 'Song not found'], 404);
        }

        $song->listening_count += 1;
        $song->save();

        return response()->json(['message' => 'Listening count incremented']);
    }


    /**
     * Displays a page with details of a specific song.
     * If the song is private, access is restricted to the song's performer or an authenticated user with appropriate permissions.
     *
     * @param  int  $id  The ID of the song
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function song($id)
    {
        $song = Song::find($id);
        if (trim($song->status) == "private" && Auth::user()->performer->id != $song->performer_id) {
            return abort(403, 'Access denied');
        }
        $song = $this->processSongs($song, "singular");

        $playlists = false;
        if (Auth::check()) {
            $playlists = Playlist::where("user_id", "=", Auth::user()->id)->get();
        }

        return view("site.song", compact("song", "playlists"));
    }
}
