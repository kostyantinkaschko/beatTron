<?php

namespace App\Traits;

use App\Http\Requests\SongStorePostRequest;
use getID3;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\Performer;
use App\Models\Discography;
use Illuminate\Support\Facades\Auth;

trait SongTrait
{
    /**
     * Processes one or multiple Song instances to extract metadata such as extension, duration, and ratings.
     *
     * @param \Illuminate\Database\Eloquent\Collection|\App\Models\Song $media
     *     A single Song model or a collection of songs.
     * @param string $mode
     *     Processing mode: use "plural" for collections or any other value for a single item.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Song
     *     The processed song(s) with appended metadata.
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
                $song->performer_name = Performer::find($song->performer_id)->name;
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
            $media->performer_name = Performer::find($media->performer_id)->name;
        }
        return $media;
    }

    /**
     * Returns the correct pluralization form of the word "listening" in Ukrainian based on count.
     *
     * @param int $listeningCount
     *     The number of times a song was listened to.
     *
     * @return string
     *     The proper plural form ("прослуховування" or "прослуховувань").
     */
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

    /**
     * Formats one or multiple Song instances into an array for API or display purposes.
     *
     * @param \Illuminate\Database\Eloquent\Collection|\App\Models\Song $data
     *     A single Song model or a collection of songs.
     * @param string $mode
     *     Formatting mode: "alone" for a single item, "plural" for multiple.
     *
     * @return array
     *     The formatted song data.
     */
    public function songFormatting($data, $mode = "plural")
    {
        function writeData($item, $itemMedia)
        {
            return  [
                'id' => $item->id,
                'genre' => Genre::find($item->genre_id)->title,
                'performer' => Performer::find($item->performer_id)->name,
                'disk' => Discography::find($item->disk_id)->name,
                "name" => $item->name,
                "year" => $item->year,
                "status" => $item->status,
                "song" => [
                    "url" => $itemMedia->getUrl(),
                    "name" => $itemMedia->name,
                    "mime" => $itemMedia->mime_type,
                    "size" => $itemMedia->size
                ]
            ];
        }

        if ($mode == "alone") {
            $itemMedia = $data->getFirstMedia("songs");
            return writeData($data, $itemMedia);
        } else if ($mode == "plural") {
            $result = [];
            foreach ($data as $item) {
                $itemMedia = $item->getFirstMedia("songs");
                $result[] = writeData($item, $itemMedia);
            }

            return $result;
        }
    }
}
