<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PerformerResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="PerformerResource",
     *     type="object",
     *     title="Performer Resource",
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="name", type="string", example="Omega Petya"),
     *     @OA\Property(property="instagram", type="string", example="https://www.instagram.com/"),
     *     @OA\Property(property="facebook", type="string", example="https://www.facebook.com/"),
     *     @OA\Property(property="x", type="string", example="https://x.com/"),
     *     @OA\Property(property="youtube", type="string", example="https://www.youtube.com/"),
     *     @OA\Property(property="songs_count", type="integer", example=5)
     * )
     */

    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "instagram" => $this->instagram,
            "facebook" => $this->facebook,
            "x" => $this->x,
            "youtube" => $this->youtube,
            "songs_count" => $this->songs_count ?? $this->songs()->count(),
        ];
    }
}
