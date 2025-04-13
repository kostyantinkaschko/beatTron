<?php

namespace App\Http\Controllers\Admin;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\GenresStorePostRequest;

class GenreController extends Controller
{

    /**
     * Routing to the genres display page
     *
     * @return View
     */
    public function index()
    {
        $genres = Genre::withTrashed()->with(["discographies"])->get();

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
    public function store(GenresStorePostRequest $request)
    {
        Genre::create($request->validated());

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
        $genre = Genre::with(["discographies"])->find($id);

        return view("admin.genres.edit", compact('genre'));
    }

    /**
     * Updates the data of an existing disk in the database
     *
     * @param Request $request
     * @param Genre $genre
     */

    public function update(GenresStorePostRequest $request, Genre $genre)
    {

        $genre->update($request->validated());

        return to_route("genres");
    }


    /**
     * Delete a disk (soft delete)
     *
     * @param int $id
     */
    public function remove($id)
    {
        Genre::findOrFail($id)->delete();

        return to_route("genres");
    }

    /**
     * Restores a deleted disk
     *
     * @param int $id
     */
    public function restore($id)
    {
        Genre::onlyTrashed()->findOrFail($id)->restore();

        return to_route("genres");
    }
}
