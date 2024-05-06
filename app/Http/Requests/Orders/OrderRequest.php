<?php

namespace App\Http\Requests\Orders;

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
            'payment_method_nonce' => 'required',
            'customer_name' => 'required',
            'customer_address' => 'required',
            'customer_email' => 'required',
            'customer_phone_number' => 'required',
            'dishes' => 'required',
            'restaurant_id' => 'required'
        ];
    }
}