<?php

namespace App\Http\Controllers\Admin;

use App\Models\Performer;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Filters\Admin\PerformerFilterRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PerformersStorePostRequest;

class PerformersController extends Controller
{
    /**
     * Displays the performers listing page with optional search filter.
     *
     * @param PerformerFilterRequest $request The request containing search filter.
     * @return View The view displaying the list of performers.
     */
    public function index(PerformerFilterRequest $request)
    {
        $performers = Performer::withTrashed()
            ->with(["discographies"])
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $search = $request->search;
                    $query->where('name', 'like', "%$search%");
                });
            })
            ->paginate(50);

        return view("admin.performers.performers", compact("performers"));
    }

    /**
     * Displays the page for creating a new performer.
     *
     * @return View The view displaying the performer creation form.
     */
    public function create()
    {
        return view("admin.performers.create");
    }


    /**
     * Stores a newly created performer in the database.
     *
     * @param PerformersStorePostRequest $request The validated request containing performer data.
     * @return \Illuminate\Http\RedirectResponse Redirects to the performers listing page.
     */
    public function store(PerformersStorePostRequest $request)
    {
        $performer = $request->validated();
        $performer['user_id'] =  Auth::id();

        Performer::create($performer);

        return to_route("performers");
    }

    /**
     * Displays the edit form for a specific performer.
     *
     * @param int $id The ID of the performer to edit.
     * @return View The view displaying the performer edit form.
     */
    public function edit($id)
    {
        $performer = Performer::with(["discographies"])->find($id);

        return view("admin.performers.edit", compact('performer'));
    }

    /**
     * Updates the data of an existing performer in the database.
     *
     * @param PerformersStorePostRequest $request The validated request with updated performer data.
     * @param Performer $performer The performer model to update.
     * @return \Illuminate\Http\RedirectResponse Redirects to the performers listing page.
     */
    public function update(PerformersStorePostRequest $request, Performer $performer)
    {
        $performer->update($request->validated());

        return to_route("performers");
    }

    /**
     * Soft deletes the specified performer.
     *
     * @param int $id The ID of the performer to delete.
     * @return \Illuminate\Http\RedirectResponse Redirects to the performers listing page.
     */
    public function remove($id)
    {
        Performer::findOrFail($id)->delete();
        return to_route("performers");
    }

    /**
     * Restores a previously soft-deleted performer.
     *
     * @param int $id The ID of the performer to restore.
     * @return \Illuminate\Http\RedirectResponse Redirects to the performers listing page.
     */
    public function restore($id)
    {
        Performer::onlyTrashed()->findOrFail($id)->restore();
        return to_route("performers");
    }
}
