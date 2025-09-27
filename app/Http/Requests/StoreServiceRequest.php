<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Return true for now, or add authorization logic here.
        // Alternatively, you can handle authorization in the controller.
        return true;
    }
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:100',
            'description' => 'nullable|string|max:500',
            'status' => 'required|string|in:active,inactive,pending',
            'provider_id' => 'required|exists:users,id',
            'duration' => 'required|numeric|min:5',
            'price' => 'required|numeric|min:0|max:10000',
        ];
    }

    public function messages(): array
    {
        return  [
            'name.required' => 'The service name is required.',
            'name.min' => 'The service name must be at least 2 characters.',
            'duration.min' => 'Duration must be at least 5 minutes.',
            'price.min' => 'Price cannot be negative.',
            'status.in' => 'Status must be active, inactive, or pending.',
        ];
    }
}
