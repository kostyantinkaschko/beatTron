<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PerformersStorePostRequest extends FormRequest
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
            "instagram" => ["required", "string", "max:255"],
            "facebook" => ["required", "string", "max:255"],
            "x" => ["required", "string", "max:255"],
            "youtube" => ["required", "string", "max:255"],
        ];
    }

    public function messages()
    {
        return [
            "name" => "This parameter is required and has a maximum length of 255 characters.",
            'instagram' => "This parameter is required and has a maximum length of 255 characters.",
            'facebook' => "This parameter is required and has a maximum length of 255 characters.",
            "x" => "This parameter is required and has a maximum length of 255 characters.",
            "youtube" => "This parameter is required and has a maximum length of 255 characters.", 
        ];
    }
}
