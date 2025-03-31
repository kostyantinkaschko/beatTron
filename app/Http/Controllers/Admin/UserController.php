<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
      $users = User::withTrashed()->get();
  
      return view("admin.users.users", compact("users"));
    }
  
    public function store(Request $request)
    {
      User::store([
        'genre_id' => $request->post('genre_id'),
        'author' => $request->post('author'),
        'type' => $request->post('type'),
        'description' => $request->post('description'),
        'created_at' => now(),
        "updated_at" => now(),
      ]);
  
      return to_route("users");
    }
  
    public function edit($id)
    {
      $user = User::find($id);
  
      return view("admin.users.edit", compact('user'));
    }
  
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
    public function remove($id)
    {
      $user = User::findOrFail($id);
      $user->delete();
      return to_route("users");
    }
    public function restore($id)
    {
      $user = User::onlyTrashed()->findOrFail($id);
      $user->restore();
      return to_route("users");
    }
}
