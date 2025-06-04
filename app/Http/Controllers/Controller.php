<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function force404()
    {
        abort(404);
    }
}
