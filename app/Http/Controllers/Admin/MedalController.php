<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Medal;
use App\Models\Song;

class MedalController extends Controller
{
    public function index()
    {
        $medals = Medal::withTrashed()->get();


        return view("admin.medals.medals", compact("medals"));
    }

    public function create(): View
    {
        return view('admin.medals.create');
    }

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

    public function edit($id)
    {
        $medal = Medal::find($id);

        return view("admin.medals.edit", compact('medal'));
    }

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

    public function remove($id)
    {
        $medal = Medal::findOrFail($id);
        $medal->delete();
        return to_route("medals");
    }
    public function restore($id)
    {
      $medal = Medal::onlyTrashed()->findOrFail($id);
      $medal->restore();
      return to_route("medals");
    }
}
