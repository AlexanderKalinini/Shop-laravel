<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:30'],
            'surname' => ['required', 'string', 'min:2', 'max:30'],
            'phoneNumber' => ['nullable', 'string', 'min:5', 'max:30'],
            'email' => ['required', 'email', 'max:30'],
            'deliveryMethod' => ['required', 'string'],
            'city' => ['max:50', $this->input('deliveryMethod') === 'delivery' ? 'required' : 'nullable', 'string',],
            'street' => ['max:50', $this->input('deliveryMethod') === 'delivery' ? 'required' : 'nullable', 'string',],
            'paymentMethod' => ['required', 'string'],
            'promo' => ['nullable', 'numeric',],
            'cart' => ['required', 'json'],
        ];
    }
}
