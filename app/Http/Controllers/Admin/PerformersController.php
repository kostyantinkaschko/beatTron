<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Performer;


class PerformersController extends Controller
{
  public function index()
  {
    $performers = Performer::withTrashed()->get();

    return view("admin.performers.performers", compact("performers"));
  }

  public function create()
  {
    return view("admin.performers.create");
  }
  public function store(Request $request)
  {
    Performer::store([
      'id' => $request->post('id'),
      'user_id' => Auth::id(),
      'name' => $request->post('name'),
      'instagram' => $request->post('instagram'),
      'facebook' => $request->post('facebook'),
      'youtube' => $request->post('youtube'),
      'created_at' => now(),
      "updated_at" => now(),
    ]);

    return to_route("performers");
  }

  public function edit($id)
  {
    $performer = Performer::find($id);
    return view("admin.performers.edit", compact('performer'));
  }

  public function update(Request $request, Performer $performer)
  {
    $performer->update([
      'user_id' => $request->post("user_id"),
      'name' => $request->post("name"),
      'instagram' => $request->post("instagram"),
      'facebook' => $request->post("facebook"),
      'youtube' => $request->post("youtube"),
    ]);

    return to_route("performers");
  }
  public function remove($id)
  {
    $performer = Performer::findOrFail($id);
    $performer->delete();
    return to_route("performers");
  }
  public function restore($id)
  {
    $performer = Performer::onlyTrashed()->findOrFail($id);
    $performer->restore();
    return to_route("performers");
  }
}
