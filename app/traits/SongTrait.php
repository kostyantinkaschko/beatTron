<?php

namespace App\Traits;

use getID3;

trait SongTrait
{
    /**
     * Trait to handle song-related functionalities, such as processing song media.
     *
     * This trait includes a method to process song media files and retrieve their
     * metadata such as file extension and duration.
     *
     * @method mixed processSongs(\Illuminate\Database\Eloquent\Collection|\App\Models\Song $media, string $mode = 'plural') Process and retrieve metadata for the provided song(s).
     *
     * @param \Illuminate\Database\Eloquent\Collection|\App\Models\Song $media The song(s) to be processed. Can be a single song or a collection of songs.
     * @param string $mode The processing mode, either "plural" for a collection of songs or other values for a single song. Defaults to "plural".
     *
     * @return mixed The processed song(s) with added metadata like file extension and duration.
     */

    public function processSongs($media, $mode = "plural")
    {
        $getID3 = new getID3();
        $projectPath = str_replace("\public", '/', public_path());
        $basePath = $projectPath . 'resources/songs/';
        $extensions = ["mp3", "wav", "flac"];


        if ($mode == "plural") {
            foreach ($media as $song) {
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
        } else {
            foreach ($extensions as $extension) {
                $filePath = $basePath . $media->id . '.' . $extension;
                if (file_exists($filePath)) {
                    $media->extension = $extension;
                    $media->filePath = $filePath;
                    break;
                }
            }

            $info = $getID3->analyze($media->filePath);
            $media->duration = $info['playtime_string'] ?? null;
        }

        return $media;
    }
}
