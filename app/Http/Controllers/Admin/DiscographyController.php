<?php

namespace App\Http\Controllers\Admin;

use App\Models\Genre;
use App\Models\Performer;
use App\Models\Discography;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DiscographyStorePostRequest;
use App\Http\Requests\Filters\Admin\DiscographyFilterRequest;

class DiscographyController extends Controller
{
    /**
     * Displays the discography listing page with optional filters.
     *
     * @param DiscographyFilterRequest $request The request containing filter parameters.
     * @return View The view of the discography listing.
     */
    public function index(DiscographyFilterRequest $request)
    {
        $disks = Discography::withTrashed()
            ->with(['genre', 'performer'])
            ->when($request->filled('genre_id'), fn($q) => $q->where('genre_id', $request->genre_id))
            ->when($request->filled('type'), fn($q) => $q->where('type', $request->type))
            ->when($request->filled('performer_id'), fn($q) => $q->where('performer_id', $request->performer_id))
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $search = $request->search;
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%");
                });
            })
            ->paginate(50);

        $genres = Genre::select('id', 'title')->get();
        $performers = Performer::select('id', 'name')->get();

        return view("admin.discography.discography", compact('disks', 'genres', 'performers'));
    }


    /**
     * Displays the page for creating a new disc entry.
     *
     * @return View The view of the disc creation form.
     */
    public function create()
    {
        $genres = Genre::select("id", "title")->get();
        $performers = Performer::select("id", 'name')->get();

        return view("admin.discography.create", compact("genres", "performers"));
    }

    /**
     * Stores a newly created disc in the database.
     *
     * @param DiscographyStorePostRequest $request The validated request containing disc data.
     * @return RedirectResponse Redirects to the discography listing page.
     */
    public function store(DiscographyStorePostRequest $request)
    {

        $disk = Discography::create($request->validated());
        $disk->image = $request->file('image')->store('disks', 'public');
        $disk->addMedia($request->file('image'))
            ->toMediaCollection("disks");

        return to_route("discography");
    }

    /**
     * Displays the edit form for a specific disc.
     *
     * @param int $id The ID of the disc to edit.
     * @return View The view of the disc edit form.
     */
    public function edit($id)
    {
        $disk = Discography::find($id);
        $genres = Genre::select("id", "title")->get();
        $performers = Performer::select("id", 'name')->get();

        return view("admin.discography.edit", compact('disk', 'genres', 'performers'));
    }


    /**
     * Updates an existing disc with the provided data.
     *
     * @param DiscographyStorePostRequest $request The validated request containing updated disc data.
     * @param Discography $disk The disc model to update.
     * @return RedirectResponse Redirects to the discography listing page.
     */
    public function update(DiscographyStorePostRequest $request, Discography $disk)
    {
        $disk->update($request->validated());
        $disk->image = $request->file('image')->store('disks', 'public');

        $file = $disk->getFirstMedia("disks");

        if ($file) {
            $file->delete();
        }


        $disk->addMedia($request->file('image'))
            ->toMediaCollection("disks");

        return to_route("discography");
    }


    /**
     * Soft deletes a disc by its ID.
     *
     * @param int $id The ID of the disc to delete.
     * @return RedirectResponse Redirects to the discography listing page.
     */
    public function remove($id)
    {
        Discography::findOrFail($id)->delete();

        return to_route("discography");
    }

    /**
     * Restores a previously soft-deleted disc by its ID.
     *
     * @param int $id The ID of the disc to restore.
     * @return RedirectResponse Redirects to the discography listing page.
     */
    public function restore($id)
    {
        Discography::onlyTrashed()->findOrFail($id)->restore();

        return to_route("discography");
    }
}
