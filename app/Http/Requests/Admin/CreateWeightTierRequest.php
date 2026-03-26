<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateWeightTierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'price_per_kg' => 'required|numeric|min:0',  // ₦ per kg (e.g. 90)
            'min_weight' => 'nullable|numeric|min:0',
            'max_weight' => 'nullable|numeric',
            'multiplier' => 'nullable|integer|min:1',
            'base_service_fee' => 'nullable|numeric|min:0',
            'region_id' => 'required|string|max:50',
            'is_active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'price_per_kg.required' => 'Price per kg is required',
            'price_per_kg.min' => 'Price per kg must be at least 0',
            'region_id.required' => 'Region ID is required',
        ];
    }
}
