<?php

namespace App\Http\Controllers\PerformerPanel;

use App\Models\Genre;
use App\Models\Performer;
use App\Models\Discography;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DiscographyFilterRequest;
use App\Http\Requests\DiscographyStorePostRequest;

class DiscographyController extends Controller
{
    /**
     * Routing to the disk creation display page
     *
     * @return View
     */
    public function create(): View
    {
        $genres = Genre::select("id", "title")->get();
        $performers = Performer::select("id", 'name')->get();

        return view("performerPanel.discography.create", compact("genres", "performers"));
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

        return to_route("performerPanel/discography");
    }
    /**

     * Routing to the disk edit display page
     *
     * @param int $id
     * @return View
     */
    public function edit($id): View
    {
        $disk = Discography::find($id);
        $genres = Genre::select("id", "title")->get();
        $performers = Performer::select("id", 'name')->get();

        return view("performerPanel.discography.edit", compact('disk', 'genres', 'performers'));
    }

    /**
     * Displays a paginated list of disks with filtering options.
     * Filters disks by genre, type, performer, and search terms.
     *
     * @param  \Illuminate\Http\Request  $request  The request containing filtering data
     * @return \Illuminate\View\View
     */
    public function index(DiscographyFilterRequest $request): View
    {
        $disks = Discography::withTrashed()
            ->where("performer_id", "=", Auth::user()->performer->id)
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

        return view("performerPanel.discography.discography", compact('disks', 'genres', 'performers'));
    }


    /**
     * Updates the data of an existing disk in the database
     *
     * @param Request $request
     * @param Discography $disk
     */
    public function diskUpdate(DiscographyStorePostRequest $request, Discography $disk)
    {

        $disk->update($request->validated());

        return to_route("performerPanel/discography");
    }

    /**
     * Delete a disk (mild delete)
     *
     * @param int $id
     */
    public function remove($id)
    {
        Discography::findOrFail($id)->delete();

        return to_route("performerPanel/discography");
    }

    /**
     * Restores a deleted disk
     *
     * @param int $id
     */
    public function Restore($id)
    {
        Discography::where("performer_id", "=", Auth::user()->performer->id)->onlyTrashed()->findOrFail($id)->restore();

        return to_route("performerPanel/discography");
    }
}
