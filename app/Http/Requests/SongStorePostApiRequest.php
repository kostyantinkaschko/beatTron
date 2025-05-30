<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongStorePostApiRequest extends FormRequest
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
            'genre' => ["required", "string", "max:100"],
            'performer' => ["required", "string", "max:100"],
            'disk' => ["required", "string", "max:100"],
            "name" => ["required", "string", "max:255"],
            'year' => ["required", "integer"],
            'status' => ["required", "string", "max:32"],
            'song' => ["required", "array"],

            'song.*.url' => ['required', 'string'],
            'song.*.name' => ['required', 'string'],
            'song.*.mime' => ['required', 'string'],
            'song.size' => ['required', 'integer']

        ];
    }
}
