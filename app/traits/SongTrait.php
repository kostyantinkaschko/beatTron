<?php
namespace App\Traits;

use getID3;

trait SongTrait
{
    public function processSongs($songs)
    {
        $getID3 = new getID3;
        $projectPath = str_replace("\public", '/', public_path());  
        $basePath = $projectPath . 'resources/songs/';
        $extensions = ["mp3", "wav", "flac"];

        foreach ($songs as $song) {
            foreach ($extensions as $extension) {
                $filePath = $basePath . $song->id . '.' . $extension;
                if (file_exists($filePath)) {
                    $song->extension = $extension;
                    $song->filePath = $filePath;
                    break;
                }
            }

            if (!isset($song->filePath) || !file_exists($song->filePath)) {
                continue;
            }

            $info = $getID3->analyze($song->filePath);
            $song->duration = $info['playtime_string'] ?? null;
        }

        return $songs;
    }
}
