<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PlaylistsController extends Controller
{
     /** 
     * Transfer to view playlists
     * 
     * @param int $playlists
     * @return Views
     */
    public function playlists(): View 
    {
        return view('playlists');
    }
}
