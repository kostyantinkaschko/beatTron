<?php

namespace App\Http\Controllers\Admin;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\GenresStorePostRequest;
use App\Http\Requests\Filters\Admin\GenreFilterRequest;

class GenreController extends Controller
{
    /**
     * Displays the genres listing page with optional filters.
     *
     * @param GenreFilterRequest $request The request containing filter parameters.
     * @return View The view displaying the list of genres.
     */
    public function index(GenreFilterRequest $request)
    {
        $genres = Genre::withTrashed()
            ->with(["discographies"])
            ->when($request->filled('title'), fn($q) => $q->where('title', 'like', '%' . $request->title . '%'))
            ->when($request->filled('year'), fn($q) => $q->where('year', '=', $request->year))
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $search = $request->search;
                    $query->where('title', 'like', "%$search%")
                        ->orWhere('year', '=', "$search");
                });
            })
            ->paginate(50);

        $years = Genre::select('year')
            ->distinct()
            ->whereNotNull('year')
            ->orderByDesc('year')
            ->pluck('year');

        return view("admin.genres.genres", compact("genres", "years"));
    }
    /**
     * Displays the page for creating a new genre.
     *
     * @return View The view displaying the genre creation form.
     */
    public function create(): View
    {
        return view('admin.genres.create');
    }


    /**
     * Stores a newly created genre in the database.
     *
     * @param GenresStorePostRequest $request The validated request containing genre data.
     * @return \Illuminate\Http\RedirectResponse Redirects to the genres listing page.
     */
    public function store(GenresStorePostRequest $request)
    {
        Genre::create($request->validated());

        return to_route("genres");
    }



    /**
     * Displays the edit form for a specific genre.
     *
     * @param int $id The ID of the genre to edit.
     * @return View The view displaying the genre edit form.
     */
    public function edit($id)
    {
        $genre = Genre::with(["discographies"])->find($id);

        return view("admin.genres.edit", compact('genre'));
    }

    /**
     * Updates the data of an existing genre in the database.
     *
     * @param GenresStorePostRequest $request The validated request with updated genre data.
     * @param Genre $genre The genre model to update.
     * @return \Illuminate\Http\RedirectResponse Redirects to the genres listing page.
     */
    public function update(GenresStorePostRequest $request, Genre $genre)
    {

        $genre->update($request->validated());

        return to_route("genres");
    }


    /**
     * Soft deletes the specified genre.
     *
     * @param int $id The ID of the genre to delete.
     * @return \Illuminate\Http\RedirectResponse Redirects to the genres listing page.
     */
    public function remove($id)
    {
        Genre::findOrFail($id)->delete();

        return to_route("genres");
    }

    /**
     * Restores a previously soft-deleted genre.
     *
     * @param int $id The ID of the genre to restore.
     * @return \Illuminate\Http\RedirectResponse Redirects to the genres listing page.
     */
    public function restore($id)
    {
        Genre::onlyTrashed()->findOrFail($id)->restore();

        return to_route("genres");
    }
}
