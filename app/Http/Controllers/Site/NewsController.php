<?php

namespace App\Http\Controllers\Site;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Displays a page with a specific news article.
     *
     * @param  int  $id  The ID of the article
     * @return \Illuminate\View\View
     */
    public function article($id)
    {
        $article = News::find($id);

        return view("site.news.article", compact("article"));
    }
}
