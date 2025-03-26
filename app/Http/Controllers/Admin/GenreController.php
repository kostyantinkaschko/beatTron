<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{

    public function index()
    {
        $genres = Genre::getGenres();
        
        return view("admin.genres.genres", compact("genres"));
    }

    /** 
     * Transfer to create genre
     * 
     * @param int $genres  
     * @return View
     */
    public function create(): View
    {
        return view('admin.genres.create');
    }

    public function store(Request $request)
    {
        $genreData = [
            'title' => $request->post('title'),
            'description' => $request->post('description'),
            'created_at' => now(),
            "updated_at" => now(),
        ];
        Genre::store($genreData);

        return to_route("genres");
    }

    public function remove($id)
    {
        Genre::deleteGenre($id);

        return to_route("genres");
    }

    public function edit($id){
        $genre = Genre::getGenre($id);
        // dd($genre);

        return view("admin.genres.edit", compact('genre'));
    }

    public function update(Request $request, $id){
        $genre = [
            'title' => $request->post("title"),
            'description' => $request->post("description")
        ];
        Genre::updateGenre($genre, $id);

        return to_route("genres");
    }
}
