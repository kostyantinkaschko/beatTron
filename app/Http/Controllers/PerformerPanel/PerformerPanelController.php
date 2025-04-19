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
    public function index()
    {
        return view("performerPanel.performerPanel");
    }
    

    public function performerEdit($id) {
        $performer = Performer::find($id);

        return view("performerPanel.performerEdit", compact("performer"));
    }

     /**
     * Updates the data of an existing performer in the database
     *
     * @param Request $request
     * @param Performer $performer
     */
    public function performerUpdate(PerformersStorePostRequest $request, Performer $performer)
    {
        // dd($performer);
        $performer->update($request->validated());
        
        return to_route("performerPage", $performer->id);  
    }

}
