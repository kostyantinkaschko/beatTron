<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait StoreTrait
{
    public static function store($data)
    {
        return DB::table((new self)->getTable())->insert($data);
    }
}
