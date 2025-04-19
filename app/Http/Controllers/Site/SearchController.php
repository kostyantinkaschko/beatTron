<?php

namespace App\Http\Controllers\Site;

use App\Models\Song;
use App\Models\Performer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $userRequest = $request->input('search');

        if (empty($userRequest)) {
            return view("site.search", ['result' => []]);
        }

        $songs = Song::with('performer')
            ->where('name', 'LIKE', '%' . $userRequest . '%')
            ->orWhereHas('performer', function ($query) use ($userRequest) {
                $query->where('name', 'LIKE', '%' . $userRequest . '%');
            })
            ->paginate(50);

        $getID3 = new \getID3;
        $result = [];

        foreach ($songs as $song) {
            $extensions = ["mp3", "wav", "flac"];
            $found = false;

            $projectPath = str_replace("\public", '/', public_path());
            $basePath = $projectPath . 'resources/songs/';

            foreach ($extensions as $ext) {
                $filePath = $basePath . $song->id . '.' . $ext;
                if (file_exists($filePath)) {
                    $song->filePath = $filePath;
                    $song->extension = $ext;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                continue;
            }

            $duration = null;
            if (file_exists($song->filePath)) {
                $info = $getID3->analyze($song->filePath);
                $duration = $info['playtime_string'] ?? null;
            }

            // Не створюємо асоціативний масив, а просто додаємо сам об'єкт моделі
            $song->duration = $duration;
            $result[] = $song;
        }

        if (empty($result)) {
            $result = false;
        }

        return view("site.search", compact("result", "songs"));
    }
}
