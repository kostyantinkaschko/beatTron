<?php

namespace App\Http\Controllers\Site;

use App\Models\Song;
use App\Models\Playlist;
use App\Models\Performer;
use App\Traits\SongTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    use SongTrait;


    /**
     * Handles the search functionality for songs and performers.
     * Searches for songs by name or performer name and returns matching results.
     * If the user is authenticated, their playlists are also retrieved.
     *
     * @param  \Illuminate\Http\Request  $request  The request containing the search input
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $userRequest = $request->input('search');

        if (empty($userRequest)) {
            return view("site.search", ['result' => []]);
        }

        $songs = $this->processSongs(Song::where("status", "=", "public")
            ->with('performer')
            ->where('name', 'LIKE', '%' . $userRequest . '%')
            ->orWhereHas('performer', function ($query) use ($userRequest) {
                $query->where('name', 'LIKE', '%' . $userRequest . '%');
            })
            ->paginate(50));


        if (Auth::check()) {
            $playlists = Playlist::where("user_id", "=", Auth::user()->id)->get();
        }


        return view("site.search", compact("songs", "playlists"));
    }
}
