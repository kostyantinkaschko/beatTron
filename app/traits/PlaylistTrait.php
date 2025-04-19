<?php

namespace App\Traits;

use App\Models\Playlist;
use Illuminate\Support\Facades\Auth;

trait PlaylistTrait
{
    public function playlist()
    {
        if (Auth::check()) {
            return Playlist::where("user_id", "=", Auth::user()->id)->get();
        }
    }
}
