<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlaylistController extends Controller
{
    public function site() 
    {
        return view("site.playlists.playlists");
    }
}
