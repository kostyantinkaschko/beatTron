<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Discography;
use Illuminate\Http\Request;

class DiscographyController extends Controller
{
    public function index()
    {
        $disks = Discography::withTrashed()->paginate(50);

        return view("site.discography.discography", compact("disks"));
    }

    public function disk($id)
    {
        $disk = Discography::with(["performer", "genre", "songs"])->find($id);
        $getID3 = new \getID3;
        $extensions = ["mp3", "wav", "flac"];
        $projectPath = str_replace("\public", '/', public_path());
        $basePath = $projectPath . 'resources/songs/';

        foreach ($disk->songs as $song) {
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

        return view("site.discography.disk", compact("disk"));
    }
}
