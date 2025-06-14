<?php

namespace App\Http\Controllers\Admin;

use App\Models\Medal;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedalStorePostRequest;

class MedalController extends Controller
{
    /**
     * Routing to the medals display page
     *
     * @return View
     */
    public function index(Request $request)
    {
        $medals = Medal::withTrashed()
        ->when($request->filled('name'), fn ($q) => $q->where('name', 'like', '%' . $request->name . '%'))
        ->when($request->filled('difficulty'), fn ($q) => $q->where('difficulty', 'like', '%' . $request->difficulty . '%'))
        ->when($request->filled('search'), function ($q) use ($request) {
            $q->where(function ($query) use ($request) {
                $search = $request->search;
                $query->where('name', 'like', "%$search%")
                      ->orWhere('difficulty', 'like', "%$search%")
                      ->orWhere('status', 'like', "%$search%");
            });
        })
        ->paginate(50);



        return view("admin.medals.medals", compact("medals"));
    }


    /**
     * Routing to the medal creation display page
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.medals.create');
    }

    /**
     * Stores a new medal in the database
     *
     * @param Request $request
     */
    public function store(MedalStorePostRequest $request)
    {
        Medal::create($request->validated());

        return to_route("medals");
    }

    /**
     * Routing to the medal edit display page
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $medal = Medal::find($id);

        return view("admin.medals.edit", compact('medal'));
    }

    /**
     * Updates the data of an existing medal in the database
     *
     * @param Request $request
     * @param Medal $medal
     */
    public function update(MedalStorePostRequest $request, Medal $medal)
    {
        $medal->update($request->validated());

        return to_route("medals");
    }

    /**
     * Delete a medal (mild delete)
     *
     * @param int $id
     */
    public function remove($id)
    {
        Medal::findOrFail($id)->delete();
        return to_route("medals");
    }
    /**
    * Restores a deleted medal
    *
    * @param int $id
    */
    public function restore($id)
    {
        Medal::onlyTrashed()->findOrFail($id)->restore();
        return to_route("medals");
    }
}
