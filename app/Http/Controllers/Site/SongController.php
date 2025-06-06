<?php

namespace App\Http\Controllers\Site;

use App\Http\Services\GoogleTagManagerService;
use App\Models\Song;
use App\Models\Playlist;
use App\Traits\SongTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Discography;
use Illuminate\Support\Facades\Auth;

class SongController extends Controller
{
    use SongTrait;

    protected GoogleTagManagerService $service;

    public function __construct(GoogleTagManagerService $service)
    {
        $this->service = $service;
    }

    /**
     * Increment the listening count for a specific song.
     *
     * Finds the song by ID and increments its listening count by one.
     * Returns a JSON response indicating success or failure.
     *
     * @param  Request  $request  The HTTP request instance.
     * @param  int  $id  The ID of the song to increment.
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
     * Display the page with detailed information about a specific song.
     *
     * Applies access control: if the song is marked as "private",
     * only the associated performer (or authorized user) may view it.
     * Processes the song with additional data formatting.
     * Loads user playlists if authenticated.
     *
     * @param  int  $id  The ID of the song.
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
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
            $playlists = Playlist::where("user_id", "=",  Auth::id())->get();
        }

        $disk = Discography::find($song->disk_id);

        return view("site.song", compact("song", "playlists", "disk"));
    }

    /**
     * Return a dataLayer-compatible array for Google Tag Manager's view_item event.
     *
     * Typically used in frontend scripts to signal GTM events.
     *
     * @return array<string, string>
     */
    public function viewSongPage()
    {
        return [
            'event' => 'view_item'
        ];
    }
    /**
     * Display the song page using advanced formatting and GTM data.
     *
     * Finds the song by ID (fails if not found), applies formatting,
     * and prepares Google Tag Manager (GTM) data for the frontend.
     *
     * @param  int  $id  The ID of the song.
     * @return \Illuminate\View\View
     */

    public function show($id)
    {
        $song = Song::findOrFail($id);
        $song = $this->songFormatting($song, 'alone');

        $songGTM = $this->service->viewSongPage($song);
        // dd($songGTM);
        return view('site.song.show', compact('song', 'songGTM'));
    }
}
