<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Discrography;
use App\Models\Song;


class DiscographyController extends Controller
{
  public function index()
  {
    $disks = Discrography::getDisks();
    
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
}
