<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;


/**
 * @OA\Schema(
 *     schema="SongStorePostRequest",
 *     required={"genre_id", "performer_id", "disk_id", "name", "listening_count", "year", "status"},
 *     @OA\Property(property="genre_id", type="integer", example=1),
 *     @OA\Property(property="performer_id", type="integer", example=1),
 *     @OA\Property(property="disk_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Omega Petya"),
 *     @OA\Property(property="listening_count", type="integer", example=1),
 *     @OA\Property(property="year", type="integer", example=2024),
 *     @OA\Property(property="status", type="string", example="public")
 * )
 */
class SongStorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'genre_id' => ['required', 'integer', 'exists:genres,id'],
            'performer_id' => ['required', 'integer', 'exists:performers,id'],
            'disk_id' => ['required', 'integer', 'exists:discography,id'],
            'name' => ['required', 'string'],
            'year' => ['required', 'integer'],
            'status' => ['required', 'string', 'in:public,private'],
            'song' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'file',
                'mimetypes:audio/mpeg,audio/wav,audio/flac',
            ],
        ];
    }

    public function messages()
    {
        return [
            'genre_id.required' => "This genre cannot be selected",
            'genre_id.exists' => "This genre cannot be selected",
            'performer_id.required' => "This performer cannot be selected",
            'performer_id.exists' => "This performer cannot be selected",
            'disk_id.required' => "This disk cannot be selected",
            'disk_id.exists' => "This disk cannot be selected",
            'name.required' => "This parameter is required and has a maximum length of 255 characters.",
            'year.required' => "This parameter is required and its value must be a number.",
            'status.required' => "This parameter is required and has a maximum length of 32 characters.",
            'song.file' => "Something went wrong with the song file.",
            'song.mimetypes' => "Unsupported audio format.",
        ];
    }
}
