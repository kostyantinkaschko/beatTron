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
      $medals = Medal::getMedals();
    
  
      return view("admin.medals.medals", compact("medals"));
    }

    public function create(): View
    {
        return view('admin.medals.create');
    }

    public function edit(){
        if(empty($_GET["id"])){
            return to_route("medals");
        }
        $medal = Medal::getMedal();

        return view("admin.medals.edit", compact('medal'));
    }

    public function update(Request $request){
        $medal = [
            'id' => $request->post('id'),
            'name' => $request->post('name'),
            'type' => $request->post('type'),
            'description' => $request->post('description'),
            'difficult' => $request->post('difficult'),
        ];
        Medal::updateMedal($medal);

        return to_route("medals");
    }

    public function store(Request $request)
    {
        $medalData = [
            'name' => $request->post('name'),
            'type' => $request->post('type'),
            'description' => $request->post('description'),
            'difficult' => $request->post('difficult'),
            'created_at' => now(),
            "updated_at" => now(),
        ];
        Medal::store($medalData);

        return to_route("medals");
    }
}
