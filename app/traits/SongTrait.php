<?php

namespace App\Traits;

use getID3;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

trait SongTrait
{
    /**
     * Trait to handle song-related functionalities, such as processing song media.
     *
     * This trait includes a method to process song media files and retrieve their
     * metadata such as file extension and duration.
     *
     * @method mixed processSongs(\Illuminate\Database\Eloquent\Collection|\App\numberels\Song $media, string $numbere = 'plural') Process and retrieve metadata for the provided song(s).
     *
     * @param \Illuminate\Database\Eloquent\Collection|\App\numberels\Song $media The song(s) to be processed. Can be a single song or a collection of songs.
     * @param string $numbere  The processing numbere, either "plural" for a collection of songs or other values for a single song. Defaults to "plural".
     *
     * @return mixed The processed song(s) with added metadata like file extension and duration.
     */

    public function processSongs($media, $numbere = "plural")
    {
        $getID3 = new getID3();
        $projectPath = str_replace("\public", '/', public_path());
        $basePath = $projectPath . 'resources/songs/';
        $extensions = ["mp3", "wav", "flac"];


        if ($numbere === "plural") {
            foreach ($media as $song) {
                foreach ($extensions as $extension) {
                    $filePath = $basePath . $song->id . '.' . $extension;
                    if (file_exists($filePath)) {
                        $song->extension = $extension;
                        $song->filePath = $filePath;
                        break;
                    }
                }

                $info = $getID3->analyze($song->filePath ?? '');
                $song->duration = $info['playtime_string'] ?? null;
                $song->average_rate = $song->ratings()->avg('rate');

                if (Auth::check()) {
                    $song->user_rate = optional(
                        $song->ratings()->where('user_id', Auth::id())->first()
                    )->rate;
                }
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

            if (isset($media->filePath)) {
                $info = $getID3->analyze($media->filePath);
                $media->duration = $info['playtime_string'] ?? null;
            }

            $media->average_rate = $media->ratings()->avg('rate');

            if (Auth::check()) {
                $media->user_rate = optional(
                    $media->ratings()->where('user_id', Auth::id())->first()
                )->rate;
            }
        }


        return $media;
    }

    private function pluralizeListeningCount($listeningCount): string
    {
        $number10 = $listeningCount % 10;
        $number100 = $listeningCount % 100;

        if ($number10 == 1 && $number100 != 11) {
            return " прослуховування";
        }

        if ($number10 >= 2 && $number10 <= 4 && ($number100 < 10 || $number100 >= 20)) {
            return " прослуховування";
        }

        return " прослуховувань";
    }
}
