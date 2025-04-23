<?php

namespace App\Http\Controllers\Site;

use App\Models\Performer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PerformersStorePostRequest;

class PerformerSiteController extends Controller
{
    /**
     * Displays a page with a list of performers, including deleted ones.
     *
     * @return \Illuminate\View\View
     */
    public function site()
    {
        $performers = Performer::select("id", "name", "instagram", "facebook", "x", "youtube")->withTrashed()->get();

        return view("site.performers.performers", compact("performers"));
    }

    /**
     * Displays a page with detailed information about a specific performer, including their discographies, news, and songs.
     * Also fetches and processes song file details (e.g., duration).
     *
     * @param  int  $id  The ID of the performer
     * @return \Illuminate\View\View
     */
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

    /**
     * Displays a page with a form to create a new performer.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view("site.performers.createPerformer");
    }


    /**
     * Handles the submission of the new performer form and stores the performer in the database.
     *
     * @param  \App\Http\Requests\PerformersStorePostRequest  $request  The request containing validated data for the new performer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PerformersStorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $performer = Performer::create($data);

        return to_route('performerPage', ['id' => $performer->id]);
    }
}
