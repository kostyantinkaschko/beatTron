<?php

namespace App\Http\Requests\Filters\PerformerPanel;

use Illuminate\Foundation\Http\FormRequest;

class SongsFilterRequest extends FormRequest
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
            'genre_id' => ['nullable', 'integer', 'exist:genres,id'],
            'performer_id' => ['nullable', 'integer', 'exist:performers,id'],
            'name' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'integer'],
            'status' => ['nullable', 'in:public,protected,private'],
            'search' => ['nullable', 'string']
        ];
    }
}
