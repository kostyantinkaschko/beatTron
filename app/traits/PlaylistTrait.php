<?php

namespace App\Traits;

use App\Models\Playlist;
use Illuminate\Support\Facades\Auth;

trait PlaylistTrait
{
    /**
     * Trait to handle playlist-related functionalities for the authenticated user.
     *
     * This trait includes a method to retrieve all playlists associated with the
     * currently authenticated user.
     *
     * @method \Illuminate\Database\Eloquent\Collection playlist() Retrieve all playlists of the authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection|null The collection of playlists associated with the authenticated user, or null if not authenticated.
     */

    public function playlist()
    {
        if (Auth::check()) {
            return Playlist::where("user_id", "=", Auth::user()->id)->get();
        }
    }
}
