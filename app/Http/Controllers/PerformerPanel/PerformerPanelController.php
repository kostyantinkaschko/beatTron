<?php

namespace App\Http\Controllers\PerformerPanel;

use App\Models\News;
use App\Models\User;
use App\Models\Genre;
use App\Models\Performer;
use App\Models\Discography;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\PerformersStorePostRequest;
use App\Http\Requests\DiscographyStorePostRequest;
use Illuminate\Contracts\View\View;

class PerformerPanelController extends Controller
{
    /**
     * Displays the performer panel homepage.
     * This is the main landing page for the performer panel.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $performer = Performer::where('user_id', Auth::id())->first();
        $news = News::where("performer_id", "=", Auth::user()->performer->id)->take(5)->get();

        return view("performerPanel.performerPanel", compact('performer', 'news'));
    }


    /**
     * Displays the edit page for a specific performer.
     * Allows the performer to update their profile details.
     *
     * @param  int  $id  The ID of the performer to edit
     * @return \Illuminate\View\View
     */
    public function performerEdit()
    {
        $performer = Performer::find(Auth::user()->performer->id);

        return view("performerPanel.performerEdit", compact("performer"));
    }

    /**
     * Updates the data of an existing performer in the database.
     * This action is triggered when the performer submits their profile updates.
     *
     * @param  \App\Http\Requests\PerformersStorePostRequest  $request  The validated request data
     * @param  \App\Models\Performer  $performer  The performer to be updated
     * @return \Illuminate\Http\RedirectResponse
     */
    public function performerUpdate(PerformersStorePostRequest $request, Performer $performer)
    {
        // dd($performer);
        $performer->update($request->validated());

        return to_route("performerPage", $performer->id);
    }
}
