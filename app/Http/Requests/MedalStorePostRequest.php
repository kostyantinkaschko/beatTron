<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedalStorePostRequest extends FormRequest
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
            "name" => ["required", "string", "max:255"],
            "type" => ["required", "string", "max:32"],
            "description" => ["required", "string", "max:3000"],
            "difficulty" => ["required", "string", "max:255"],
        ];
    }

    public function messages()
    {
        return [
            "name" => "This parameter is required and has a maximum length of 255 characters.",
            "type" => "This parameter is required and has a maximum length of 32 characters.",
            "description" => "This parameter is required and has a maximum length of 255 characters.", 
            'diffucult' => "This parameter is required and has a maximum length of 255 characters.",
        ];
    }
}
