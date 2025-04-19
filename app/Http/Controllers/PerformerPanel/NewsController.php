<?php

namespace App\Http\Controllers\PerformerPanel;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsStoreRequest;

class NewsController extends Controller
{
    public function news()
    {
        $performer_id = User::performerId();
        $news = News::where("performer_id", "=", $performer_id)->paginate(10);;

        return view("performerPanel.news", compact("news"));
    }
    public function store(NewsStoreRequest $request)
    {
        $data = $request->validated();
        $data["performer_id"] = User::performerId();
        News::create($data);

        return to_route("news");
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

        return to_route("article", $id);
    }

    
    /**
     * Delete a disk (mild delete)
     *
     * @param int $id
     */
    public function remove($id)
    {
        News::findOrFail($id)->delete();

        return to_route("performerPanel/news");
    }

    /**
     * Restores a deleted disk
     *
     * @param int $id
     */
    public function Restore($id)
    {
        News::onlyTrashed()->findOrFail($id)->restore();

        return to_route("performerPanel/news");
    }
}
