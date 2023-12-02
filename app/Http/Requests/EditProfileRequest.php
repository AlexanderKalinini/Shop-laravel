<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class EditProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["string", "min:2", "max:255", 'nullable',],
            "email" => ["string", "email", "unique:users", "max:255", "nullable",],
            "password" => ["string", "min:4", "confirmed", "nullable"],
        ];
    }
}