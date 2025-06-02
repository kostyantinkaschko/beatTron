<?php

namespace App\Repositories;

use App\Models\Performer;
use App\Traits\PerformerTrait;

class PerformerRepository
{
    use PerformerTrait;
    public function all()
    {
        $performers = Performer::withCount('songs')->get();

        return $performers;
    }



    public function find($id)
    {
        return Performer::withCount('songs')->findOrFail($id);
    }

    public function create(array $data)
    {
        $data['user_id'] = 1;
        return Performer::create($data);
    }

    public function update($data, $id)
    {
        $performer = Performer::find($id);
        if ($performer) {
            $performer->update($data);
        }
        return $performer;
    }

    public function delete($id)
    {
        return Performer::find($id)->delete();
    }
}
