<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "subcategory_id" => "",
            "title" => ["required", "string", "max:255"],
            "description" => ["required", "string", "max:999"],
        ];
    }

    public function messages()
    {
        return [
            "title" => "id is required and has to be no more than 11",
            "title" => "title is required and has to be no more than 255",
            "description" => "description is required and has to be no more than 999",
        ];
    }
}
