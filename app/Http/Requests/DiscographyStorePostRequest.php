<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscographyStorePostRequest extends FormRequest
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
            "name" => ["required", "string", "max:255"],
            "type" => ["required", "string", "max:32"],
            "description" => ["required", "string", "max:3000"], 
            'image' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,',
                'max:4096', 
            ],  
        ];
    }

    public function messages()
    {
        return [
            'genre_id' => "This genre cannot be selected",
            'performer_id' => "This performer cannot be selected",
            "name" => "This parameter is required and has a maximum length of 255 characters.",
            "type" => "This parameter is required and has a maximum length of 32 characters.",
            "description" => "This parameter is required and has a maximum length of 255 characters.", 
            "image" => "The photo must be in .jpg or .png format and be up to 4 MB in size"
        ];
    }
}
