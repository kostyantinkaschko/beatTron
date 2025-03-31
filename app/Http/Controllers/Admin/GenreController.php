<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{

    public function index()
    {
        $genres = Genre::withTrashed()->get();

        return view("admin.genres.genres", compact("genres"));
    }

    /** 
     * Transfer to create genre
     * 
     * @param int $genres  
     * @return View
     */
    public function create(): View
    {
        return view('admin.genres.create');
    }

    public function store(Request $request)
    {
        Genre::store([
            'title' => $request->post('title'),
            'description' => $request->post('description'),
            'created_at' => now(),
            "updated_at" => now(),
        ]);

        return to_route("genres");
    }



    public function edit($id)
    {
        $genre = Genre::find($id);

        return view("admin.genres.edit", compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {

        $genre->update([
            'title' => $request->post("title"),
            'description' => $request->post("description"),
        ]);

        return to_route("genres");
    }

    public function remove($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        return to_route("genres");
    }
    public function restore($id)
    {
        $genre = Genre::onlyTrashed()->findOrFail($id);
        $genre->restore();
        return to_route("genres");
    }
}
