<?php

namespace App\Http\Controllers\Site;

use App\Models\Genre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenreSiteController extends Controller
{
    public function site() 
    {
        $genres = Genre::paginate(50);

        return view("site.genres.genres", compact("genres"));
    }

    public function genre($id){
        $genre = Genre::find($id);

        return view("site.genres.genre", compact("genre"));
    }
}
