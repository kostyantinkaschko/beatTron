<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenresStorePostRequest extends FormRequest
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
            "title" => ["required", "string", "max:255"],
            "description" => ["required", "string", "max:300"],
            'year' => ["required", "integer"]
        ];
    }

    public function messages()
    {
        return [
            "title" => "This parameter is required and has a maximum length of 255 characters.",
            "description" => "This parameter is required and has a maximum length of 255 characters.",
            "year" => "This parameter is required and need be a number",
        ];
    }
}
