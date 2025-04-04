<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{

    /**
     * Routing to the genres display page
     *
     * @return View
     */
    public function index()
    {
        $genres = Genre::withTrashed()->get();

        return view("admin.genres.genres", compact("genres"));
    }

    /**
     * Routing to the genre creation display page
     *
     * @return View
     */

    public function create(): View
    {
        return view('admin.genres.create');
    }

    /**
     * Stores a new genre in the database
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        Genre::create([
            'title' => $request->post('title'),
            'description' => $request->post('description'),
            'created_at' => now(),
            "updated_at" => now(),
        ]);

        return to_route("genres");
    }



    /**
     * Routing to the genre edit display page
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $genre = Genre::find($id);

        return view("admin.genres.edit", compact('genre'));
    }

    /**
     * Updates the data of an existing disk in the database
     *
     * @param Request $request
     * @param Genre $genre
     */

    public function update(Request $request, Genre $genre)
    {

        $genre->update([
            'title' => $request->post("title"),
            'description' => $request->post("description"),
        ]);

        return to_route("genres");
    }


    /**
     * Delete a disk (mild delete)
     *
     * @param int $id
     */
    public function remove($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        return to_route("genres");
    }
    
    /**
     * Restores a deleted disk
     *
     * @param int $id
     */
    public function restore($id)
    {
        $genre = Genre::onlyTrashed()->findOrFail($id);
        $genre->restore();
        return to_route("genres");
    }
}
