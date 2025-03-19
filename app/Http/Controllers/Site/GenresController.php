<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GenresController extends Controller
{
     /** 
     * Transfer to general page of site
     * 
     * @param int $genres  
     * @return Views
     */
    public function genres(): View
    {
        return view('genres');
    }
}



