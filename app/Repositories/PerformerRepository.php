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
        foreach ($performers as $performer) {
            $performer->songCount = $performer->songs_count;
        }

        return $this->performerFormatting($performers, "plural");
    }


    public function find($id)
    {
        $performer = Performer::find($id);
        $performer->songCount = $performer->songs_count;
        return $this->performerFormatting($performer, "alone");
    }

    public function create(array $data)
    {
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
