<?php

namespace App\Http\Requests\Filters\PerformerPanel;

use Illuminate\Foundation\Http\FormRequest;

class DiscographyFilterRequest extends FormRequest
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
            'genre_id' => ['nullable', 'integer', 'max:255', 'exists:genres,id'],
            'type' => ['nullable', 'string', 'max:255', 'in:album,single'],
            'performer_id' => ['nullable', 'integer', 'max:255', 'exists:performers,id'],
            'search' => ['nullable', 'string']
        ];
    }
}
