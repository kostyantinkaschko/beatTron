<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Performer;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
   public function index()
   {
      $songs = Song::withTrashed()->get();
      $news = News::withTrashed()->get();
      $performers = Performer::withTrashed()->get();

      return view("site.general", compact("songs", "news", "performers"));
   }
}
