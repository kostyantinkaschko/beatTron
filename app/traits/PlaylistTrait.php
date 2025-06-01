<?php

namespace App\Traits;

use App\Models\Playlist;
use Illuminate\Support\Facades\Auth;

trait PlaylistTrait
{
    /**
     * Retrieve all playlists of the authenticated user.
     *
     * @return Collection|null
     */
    public function playlist()
    {
        if (Auth::check()) {
            return Playlist::where("user_id", "=",  Auth::id())->get();
        }
    }
}
