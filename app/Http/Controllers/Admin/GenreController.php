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

    public function remove()
    {
        Genre::deleteGenre();

        return to_route("genres");
    }

    public function edit(){
        if(empty($_GET["id"])){
            return to_route("genres");
        }
        $genre = Genre::getGenre();

        return view("admin.genres.edit", compact('genre'));
    }

    public function update(Request $request){
        $genre = [
            'id' => $request->post("id"),
            'title' => $request->post("title"),
            'description' => $request->post("description")
        ];
        Genre::updateGenre($genre);

        return to_route("genres");
    }
}
