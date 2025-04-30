<?php

namespace App\Http\Controllers\Site;

use App\Models\Genre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenreSiteController extends Controller
{
    /**
     * Displays a page with a list of genres.
     * Uses pagination to limit the number of genres on the page.
     *
     * @return \Illuminate\View\View
     */
    public function site()
    {
        $genres = Genre::paginate(50);

        return view("site.genres.genres", compact("genres"));
    }

    /**
     * Displays a page with details of a specific genre.
     *
     * @param  int  $id  The ID of the genre
     * @return \Illuminate\View\View
     */

    public function genre($id)
    {
        $genre = Genre::find($id);

        return view("site.genres.genre", compact("genre"));
    }
}
