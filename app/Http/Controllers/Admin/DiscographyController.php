<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Discrography;



class DiscographyController extends Controller
{
    public function index()
    {
        $disks = Discrography::withTrashed()->get();

        return view("admin.discography.discography", compact("disks"));
    }


    public function create()
    {
        return view("admin.discography.create");
    }

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

    public function edit($id)
    {
        $disk = Discrography::find($id);

        return view("admin.discography.edit", compact('disk'));
    }

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
    public function remove($id)
    {
        Discrography::findOrFail($id)->delete();

        return to_route("discography");
    }
    public function restore($id)
    {
        Discrography::onlyTrashed()->findOrFail($id)->restore();

        return to_route("discography");
    }
}