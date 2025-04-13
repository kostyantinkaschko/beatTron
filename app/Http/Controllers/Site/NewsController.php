<?php

namespace App\Http\Controllers\Site;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function article($id) {
        $article = News::find($id);

        return view("site.news.article", compact("article"));
    }
}
