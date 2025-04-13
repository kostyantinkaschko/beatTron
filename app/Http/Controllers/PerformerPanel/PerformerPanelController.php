<?php

namespace App\Http\Controllers\PerformerPanel;

use App\Models\News;
use App\Models\User;
use App\Models\Performer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\PerformersStorePostRequest;

class PerformerPanelController extends Controller
{
    public function index()
    {
        return view("performerPanel.performerPanel");
    }
    public function news()
    {
        $performer_id = User::performerId();
        $news = News::where("performer_id", "=", $performer_id)->get();

        return view("performerPanel.news", compact("news"));
    }
    public function store(NewsStoreRequest $request)
    {
        $data = $request->validated();
        $data["performer_id"] = User::performerId();
        News::create($data);

        return to_route("news");
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
    public function performerUpdate(PerformersStorePostRequest $request, Performer $performer, $id)
    {
        $performer->update($request->validated());
        
        return to_route("performerPage", $id);  
    }

    public function create()
    {
        return view("performerPanel.createNews");
    }

    public function articleEdit($id)
    {
        $article = News::find($id);
        return view("performerPanel.articleEdit", compact("article"));
    }

    
    public function articleUpdate(NewsStoreRequest $request, News $news, $id)
    {
        $news->update($request->validated());
        
        return to_route("articleм ", $id);  
    }
}
