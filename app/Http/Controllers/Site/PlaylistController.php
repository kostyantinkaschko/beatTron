<?php

namespace App\Http\Controllers\Site;

use App\Models\Playlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function site()
    {


        return view("site.playlists.playlists", compact("playlists"));
    }

    public function create()
    {
        Playlist::create(['user_id' => Auth::user()->id]);

        return view("site.playlists.playlists");
    }

    public function playlist($id)
    {
        $playlist = Playlist::find($id);
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
    }
    public function addSong(Request $request)
    {
        $playlist = Playlist::find($request->post("playlist"));
        $songId = $request->post("song");
    
        if ($playlist->songsAdd()->where('song_id', $songId)->exists()) {
            return redirect()->back();
        }
    
        $playlist->songsAdd()->attach($songId);
        return redirect()->back();
    }
}
