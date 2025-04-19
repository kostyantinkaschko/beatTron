<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'genre_id' => ["required", "integer"],
            'performer_id' => ["required", "integer"],
            'disk_id' => ["required", "integer"],
            "name" => ["required", "string", "max:255"],
            'year' => ["required", "integer"],
            'status' => ["required", "string", "max:32"],
            'song' => [
                'required',
                'file',
                'mimetypes:audio/mpeg,audio/wav,audio/flac'
            ]

        ];
    }

    public function messages()
    {
        return [
            'genre_id' => "This genre cannot be selected",
            'performer_id' => "This performer cannot be selected",
            'disk_id' => "This disk cannot be selected",
            "name" => "This parameter is required and has a maximum length of 255 characters.",
            'year' => "This parameter is required and its value must be a number.",
            "status" => "This parameter is required and has a maximum length of 32 characters.",
            "song" => "Something went wrong with the song file."
        ];
    }
}
