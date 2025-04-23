<?php

namespace App\Http\Controllers\PerformerPanel;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsStoreRequest;

class NewsController extends Controller
{
    /**
     * Displays a paginated list of news articles for the current performer.
     * Retrieves news articles associated with the logged-in performer.
     *
     * @return \Illuminate\View\View
     */
    public function news()
    {
        $performer_id = User::performerId();
        $news = News::where("performer_id", "=", $performer_id)->paginate(10);;

        return view("performerPanel.news", compact("news"));
    }

    /**
     * Stores a new news article in the database.
     * Associates the news article with the current performer.
     *
     * @param  \App\Http\Requests\NewsStoreRequest  $request  The validated request data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsStoreRequest $request)
    {
        $data = $request->validated();
        $data["performer_id"] = User::performerId();
        News::create($data);

        return to_route("performerPanel/news");
    }

    /**
     * Displays the news creation page for the performer.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view("performerPanel.createNews");
    }

    /**
     * Displays the edit page for a specific news article.
     *
     * @param  int  $id  The ID of the news article to edit
     * @return \Illuminate\View\View
     */
    public function articleEdit($id)
    {
        $article = News::find($id);
        return view("performerPanel.articleEdit", compact("article"));
    }


    /**
     * Updates the data of an existing news article in the database.
     *
     * @param  \App\Http\Requests\NewsStoreRequest  $request  The validated request data
     * @param  \App\Models\News  $news  The news article to be updated
     * @param  int  $id  The ID of the news article to update
     * @return \Illuminate\Http\RedirectResponse
     */

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
