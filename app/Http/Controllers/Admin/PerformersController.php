<?php

namespace App\Http\Controllers\Admin;

use App\Models\Performer;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PerformersStorePostRequest;


class PerformersController extends Controller
{

    /**
     * Routing to the performers display page
     *
     * @return View
     */
    public function index(Request $request)
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
     * Routing to the performer creation display page
     *
     * @return View
     */
    public function create()
    {
        return view("admin.performers.create");
    }


    /**
     * Stores a new performer in the database
     *
     * @param Request $request
     */
    public function store(PerformersStorePostRequest $request)
    {
        $performer = $request->validated();
        $performer['user_id'] = Auth::user()->id;

        Performer::create($performer);

        return to_route("performers");
    }

    /**
     * Routing to the performer edit display page
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $performer = Performer::with(["discographies"])->find($id);

        return view("admin.performers.edit", compact('performer'));
    }

    /**
     * Updates the data of an existing performer in the database
     *
     * @param Request $request
     * @param Performer $performer
     */
    public function update(PerformersStorePostRequest $request, Performer $performer)
    {
        $performer->update($request->validated());

        return to_route("performers");
    }
    /**
     * Delete a performer (soft delete)
     *
     * @param int $id
     */

    public function remove($id)
    {
        Performer::findOrFail($id)->delete();
        return to_route("performers");
    }
    /**
     * Restores a deleted performer
     *
     * @param int $id
     */
    public function restore($id)
    {
        Performer::onlyTrashed()->findOrFail($id)->restore();
        return to_route("performers");
    }
}
