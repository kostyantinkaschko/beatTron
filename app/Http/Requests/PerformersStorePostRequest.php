<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

/**
* @OA\Schema(
*     schema="PerformersStorePostRequest",
*     required={"name", "instagram", "facebook", "x", "youtube"},
*     @OA\Property(property="name", type="string", example="Omega Petya"),
*     @OA\Property(property="instagram", type="string", example="https://www.instagram.com/"),
*     @OA\Property(property="facebook", type="string", example="https://www.facebook.com/"),
*     @OA\Property(property="x", type="string", example="https://x.com/"),
*     @OA\Property(property="youtube", type="string", example="https://www.youtube.com/")
* )
*/

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
            "instagram" => ["required", "url"],
            "facebook" => ["required", "url"],
            "x" => ["required", "url", "max:255"],
            "youtube" => ["required", "url"],
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
