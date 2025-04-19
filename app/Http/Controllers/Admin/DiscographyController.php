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

class DiscographyController extends Controller
{

    /**
     * Routing to the discography display page
     *
     * @return View
     */
    public function index(Request $request)
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
     * Routing to the disk creation display page
     *
     * @return View
     */
    public function create()
    {
        $genres = Genre::select("id", "title")->get();
        $performers = Performer::select("id", 'name')->get();

        return view("admin.discography.create", compact("genres", "performers"));
    }

    /**
     * Stores a new disk in the da  tabase
     *
     * @param Request $request
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
     * Routing to the disk edit display page
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $disk = Discography::find($id);
        $genres = Genre::select("id", "title")->get();
        $performers = Performer::select("id", 'name')->get();

        return view("admin.discography.edit", compact('disk', 'genres', 'performers'));
    }


    /**
     * Updates the data of an existing disk in the database
     *
     * @param Request $request
     * @param Discography $disk
     */
    public function update(DiscographyStorePostRequest $request, Discography $disk)
    {

        $disk->update($request->validated());

        return to_route("discography");
    }

    /**
     * Delete a disk (mild delete)
     *
     * @param int $id
     */
    public function remove($id)
    {
        Discography::findOrFail($id)->delete();

        return to_route("discography");
    }

    /**
     * Restores a deleted disk
     *
     * @param int $id
     */
    public function restore($id)
    {
        Discography::onlyTrashed()->findOrFail($id)->restore();

        return to_route("discography");
    }
}
