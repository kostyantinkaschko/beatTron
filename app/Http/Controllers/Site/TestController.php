<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /** 
     * Transfer to view test
     * 
     * @param int $test
     * @return Views
     */
    public function test(): View  
    {
        return view('test');
    }
}