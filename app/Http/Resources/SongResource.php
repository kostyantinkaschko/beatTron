<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SongResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="SongResource",
     *     type="object",
     *     title="Song Resource",
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="genre", type="string", example="Rock"),
     *     @OA\Property(property="performer", type="string", example="Artist Name"),
     *     @OA\Property(property="disk", type="string", example="Disk Title"),
     *     @OA\Property(property="name", type="string", example="Song Name"),
     *     @OA\Property(property="listening_count", type="integer", example=123),
     *     @OA\Property(property="year", type="integer", example=2024),
     *     @OA\Property(property="status", type="integer", example=1),
     *     @OA\Property(property="duration", type="integer", example=210),
     *     @OA\Property(property="average_rate", type="number", format="float", example=4.5)
     * )
     */

    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "genre" => $this->genre,
            "performer" => $this->performer,
            "disk" => $this->disk,
            "name" => $this->name,
            "listening_count" => $this->listening_count,
            "year" => $this->year,
            "status" => $this->status,
            "duration" => $this->duration,
            "average_rate" => $this->average_rate
        ];
    }
}
