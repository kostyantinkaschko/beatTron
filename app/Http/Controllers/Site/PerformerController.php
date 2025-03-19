<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PerformerController extends Controller
{
     /** 
     * Transfer to view performer
     * 
     * @param int $performer
     * @return Views
     */
    public function performer(): View 
    {
        return view('performer');
    }
}
