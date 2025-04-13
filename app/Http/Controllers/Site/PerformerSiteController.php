<?php

namespace App\Http\Controllers\Site;

use App\Models\Performer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PerformersStorePostRequest;

class PerformerSiteController extends Controller
{
    public function site()
    {
        $performers = Performer::select("id", "name", "instagram", "facebook", "x", "youtube")->withTrashed()->get();

        return view("site.performers.performers", compact("performers"));
    }

    public function index($id)
    {
        $performer = Performer::with(["discographies", "news", "song"])->find($id);

        if (!$performer) {
            abort(404);
        }

        $getID3 = new \getID3;
        $extensions = ["mp3", "wav", "flac"];
        $projectPath = str_replace("\public", '/', public_path());
        $basePath = $projectPath . 'resources/songs/';

        foreach ($performer->song as $song) {
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

        return view("site.performers.performerPage", compact("performer"));
    }

    public function create()
    {
        return view("site.performers.createPerformer");
    }



    public function store(PerformersStorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $performer = Performer::create($data);

        return to_route('performerPage', ['id' => $performer->id]);
    }
}
