<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Medal;
use App\Models\Song;

class MedalController extends Controller
{
    /**
     * Routing to the medals display page
     *
     * @return View
     */
    public function index()
    {
        $medals = Medal::withTrashed()->get();


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
    public function store(Request $request)
    {
        Medal::store([
            'name' => $request->post('name'),
            'type' => $request->post('type'),
            'description' => $request->post('description'),
            'difficult' => $request->post('difficult'),
            'created_at' => now(),
            "updated_at" => now(),
        ]);

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
    public function update(Request $request, Medal $medal)
    {
        $medal->update([
            'id' => $request->post('id'),
            'name' => $request->post('name'),
            'type' => $request->post('type'),
            'description' => $request->post('description'),
            'difficult' => $request->post('difficult'),
        ]);

        return to_route("medals");
    }

      /**
     * Delete a medal (mild delete)
     *
     * @param int $id
     */
    public function remove($id)
    {
        $medal = Medal::findOrFail($id);
        $medal->delete();
        return to_route("medals");
    }
     /**
     * Restores a deleted medal
     *
     * @param int $id
     */
    public function restore($id)
    {
        $medal = Medal::onlyTrashed()->findOrFail($id);
        $medal->restore();
        return to_route("medals");
    }
}
