<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerformerSiteController extends Controller
{
    public function site() 
    {
        return view("site.performers.performers");
    }
}
