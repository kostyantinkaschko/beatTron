<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{

    /**
     * Routing to the users display page
     *
     * @return View
     */
    public function index()
    {
        $users = User::withTrashed()->get();

        return view("admin.users.users", compact("users"));
    }


    /**
     * Routing to the user edit display page
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view("admin.users.edit", compact('user'));
    }

    /**
     * Updates the data of an existing user in the database
     *
     * @param Request $request
     * @param User $user
     */
    public function update(Request $request, User $user)
    {
        $user->update([
            'genre_id' => $request->post('genre_id'),
            'author' => $request->post('author'),
            'type' => $request->post('type'),
            'description' => $request->post('description'),
        ]);
        return to_route("users");
    }
    /**
     * Delete a user (mild delete)
     *
     * @param int $id
     */
    public function remove($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return to_route("users");
    }
      /**
     * Restores a deleted user  
     *
     * @param int $id
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return to_route("users");
    }
}
