<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenreSiteController extends Controller
{
    public function site() 
    {
        return view("site.genres.genres");
    }
}
