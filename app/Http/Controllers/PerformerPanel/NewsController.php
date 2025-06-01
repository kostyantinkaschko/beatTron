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
     *
     * @return \Illuminate\View\View
     */
    public function news()
    {
        $performer_id = User::performerId();
        $news = News::where("performer_id", $performer_id)->paginate(10);

        return view("performerPanel.news", compact("news"));
    }

    /**
     * Shows the form to create a new news article.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view("performerPanel.createNews");
    }

    /**
     * Stores a new news article in the database and associates it with the current performer.
     *
     * @param  NewsStoreRequest  $request  The validated request with article data.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsStoreRequest $request)
    {
        $data = $request->validated();
        $data["performer_id"] = User::performerId();

        $article = News::create($data);

        $article->addMedia($request->file('image'))
            ->toMediaCollection("news");

        return to_route("performerPanel/news");
    }

    /**
     * Shows the form to edit an existing news article.
     *
     * @param  int  $id  The ID of the news article.
     * @return \Illuminate\View\View
     */
    public function articleEdit(int $id)
    {
        $article = News::findOrFail($id);
        return view("performerPanel.articleEdit", compact("article"));
    }

    /**
     * Updates the specified news article in the database.
     *
     * @param  NewsStoreRequest  $request  The validated request data.
     * @param  int  $id  The ID of the news article.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function articleUpdate(NewsStoreRequest $request, int $id)
    {
        $news = News::findOrFail($id);
        $news->update($request->validated());

        if ($request->hasFile('image')) {
            $file = $news->getFirstMedia("news");
            if ($file) {
                $file->delete();
            }

            $news->addMedia($request->file('image'))
                ->toMediaCollection("news");
        }

        return to_route("article", $id);
    }

    /**
     * Soft deletes the specified news article.
     *
     * @param  int  $id  The ID of the news article to delete.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(int $id)
    {
        News::findOrFail($id)->delete();

        return to_route("performerPanel/news");
    }

    /**
     * Restores a previously deleted news article.
     *
     * @param  int  $id  The ID of the news article to restore.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $id)
    {
        News::onlyTrashed()->findOrFail($id)->restore();

        return to_route("performerPanel/news");
    }
}
