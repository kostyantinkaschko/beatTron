<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Discrography;



class DiscographyController extends Controller
{

    /**
     * Routing to the discography display page
     *
     * @return View
     */
    public function index()
    {
        $disks = Discrography::withTrashed()->get();

        return view("admin.discography.discography", compact("disks"));
    }

    /**
     * Routing to the disk creation display page
     *
     * @return View
     */
    public function create()
    {
        return view("admin.discography.create");
    }

    /**
     * Stores a new disk in the database
     *
     * @param Request $request
     */ 
    public function store(Request $request)
    {
        Discrography::store([
            'genre_id' => $request->post('genre_id'),
            'author' => $request->post('author'),
            'type' => $request->post('type'),
            'description' => $request->post('description'),
            'created_at' => now(),
            "updated_at" => now(),
        ]);

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
        $disk = Discrography::find($id);

        return view("admin.discography.edit", compact('disk'));
    }


    /**
     * Updates the data of an existing disk in the database
     *
     * @param Request $request
     * @param Discrography $disk
     */
    public function update(Request $request, Discrography $disk)
    {

        $disk->update([
            'genre_id' => $request->post('genre_id'),
            'author' => $request->post('author'),
            'type' => $request->post('type'),
            'description' => $request->post('description'),
        ]);

        return to_route("discography");
    }

    /**
     * Delete a disk (mild delete)
     *
     * @param int $id
     */
    public function remove($id)
    {
        Discrography::findOrFail($id)->delete();

        return to_route("discography");
    }

    /**
     * Restores a deleted disk
     *
     * @param int $id
     */
    public function restore($id)
    {
        Discrography::onlyTrashed()->findOrFail($id)->restore();

        return to_route("discography");
    }
}
