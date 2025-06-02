<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongUpdateRequest extends FormRequest
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
        ];
    }
}
