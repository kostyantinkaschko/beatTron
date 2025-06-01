<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Displays a paginated list of users (including soft-deleted ones).
     *
     * @return View The view displaying the users list.
     */
    public function index()
    {
        $users = User::withTrashed()->paginate(50);;

        return view("admin.users.users", compact("users"));
    }


    /**
     * Shows the form for editing a specific user.
     *
     * @param int $id The ID of the user to edit.
     * @return View The view displaying the user edit form.
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view("admin.users.edit", compact('user'));
    }

    /**
     * Updates the specified user's data in the database.
     *
     * @param Request $request The request containing updated user data.
     * @param User $user The user model to update.
     * @return \Illuminate\Http\RedirectResponse Redirects to the users listing page.
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
     * Soft deletes the specified user.
     *
     * @param int $id The ID of the user to delete.
     * @return \Illuminate\Http\RedirectResponse Redirects to the users listing page.
     */
    public function remove($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return to_route("users");
    }
    /**
     * Restores a previously soft-deleted user.
     *
     * @param int $id The ID of the user to restore.
     * @return \Illuminate\Http\RedirectResponse Redirects to the users listing page.
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return to_route("users");
    }
}
