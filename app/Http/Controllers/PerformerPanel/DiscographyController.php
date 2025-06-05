<?php

namespace App\Http\Controllers\PerformerPanel;

use App\Models\Genre;
use App\Models\Performer;
use App\Models\Discography;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DiscographyStorePostRequest;
use App\Http\Requests\Filters\PerformerPanel\DiscographyFilterRequest;

class DiscographyController extends Controller
{
    /**
     * Shows the form for creating a new disk.
     *
     * @return View The view to create a new disk.
     */
    public function create(): View
    {
        $genres = Genre::select("id", "title")->get();
        $performers = Performer::select("id", 'name')->get();

        return view("performerPanel.discography.create", compact("genres", "performers"));
    }

    /**
     * Stores a newly created disk in the database.
     *
     * @param DiscographyStorePostRequest $request Validated request with disk data.
     * @return \Illuminate\Http\RedirectResponse Redirects to the disk list page.
     */
    public function store(DiscographyStorePostRequest $request)
    {
        $disk = Discography::create($request->validated());

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('disks', 'public');
            $disk->image = $path;
            $disk->save();

            $disk->addMedia($request->file('image'))
                ->toMediaCollection('disks');
        }

        return to_route('performerPanel/discography');
    }

    /**
     * Shows the form for editing an existing disk.
     *
     * @param int $id The ID of the disk to edit.
     * @return View The view to edit the disk.
     */
    public function edit($id): View
    {
        $disk = Discography::find($id);
        $genres = Genre::select("id", "title")->get();
        $performers = Performer::select("id", 'name')->get();

        return view("performerPanel.discography.edit", compact('disk', 'genres', 'performers'));
    }

    /**
     * Displays a paginated list of disks with optional filters (genre, type, performer, search).
     *
     * @param DiscographyFilterRequest $request The request containing filter parameters.
     * @return View The view displaying filtered list of disks.
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

        foreach ($disks as $disk) {
            $disk->genre = $disk->genre?->title;
        }

        $genres = Genre::select('id', 'title')->get();
        $performers = Performer::select('id', 'name')->get();

        return view("performerPanel.discography.discography", compact('disks', 'genres', 'performers'));
    }


    /**
     * Updates the data of an existing disk.
     *
     * @param DiscographyStorePostRequest $request Validated request with updated disk data.
     * @param Discography $disk The disk model to update.
     * @return \Illuminate\Http\RedirectResponse Redirects to the disk list page.
     */
    public function diskUpdate(DiscographyStorePostRequest $request, Discography $disk)
    {

        $disk->update($request->validated());

        return to_route("performerPanel/discography");
    }

    /**
     * Soft deletes the specified disk.
     *
     * @param int $id The ID of the disk to delete.
     * @return \Illuminate\Http\RedirectResponse Redirects to the disk list page.
     */
    public function remove($id)
    {
        Discography::findOrFail($id)->delete();

        return to_route("performerPanel/discography");
    }


    /**
     * Restores a previously soft-deleted disk for the authenticated performer.
     *
     * @param int $id The ID of the disk to restore.
     * @return \Illuminate\Http\RedirectResponse Redirects to the disk list page.
     */
    public function Restore($id)
    {
        Discography::where("performer_id", "=", Auth::user()->performer->id)->onlyTrashed()->findOrFail($id)->restore();

        return to_route("performerPanel/discography");
    }
}
