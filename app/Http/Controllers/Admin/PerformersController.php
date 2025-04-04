<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Performer;


class PerformersController extends Controller
{

  /**
     * Routing to the performers display page
     *
     * @return View
     */
  public function index()
  {
    $performers = Performer::withTrashed()->get();

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
  public function store(Request $request)
  {
    Performer::create([
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

     /**
     * Routing to the performer edit display page
     *
     * @param int $id
     * @return View
     */
  public function edit($id)
  {
    $performer = Performer::find($id);
    return view("admin.performers.edit", compact('performer'));
  }

     /**
     * Updates the data of an existing performer in the database
     *
     * @param Request $request
     * @param Performer $performer
     */
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
  /**
   * Delete a performer (mild delete)
   *
   * @param int $id
   */

  public function remove($id)
  {
    $performer = Performer::findOrFail($id);
    $performer->delete();
    return to_route("performers");
  }
    /**
     * Restores a deleted performer
     *
     * @param int $id
     */
  public function restore($id)
  {
    $performer = Performer::onlyTrashed()->findOrFail($id);
    $performer->restore();
    return to_route("performers");
  }
}
