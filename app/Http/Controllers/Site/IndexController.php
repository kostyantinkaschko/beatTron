<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /** 
     * Transfer to general page of site
     * 
     * @param int $general  
     * @return Views
     */
    public function index(): View
    {
        return view('index');
    }
}
