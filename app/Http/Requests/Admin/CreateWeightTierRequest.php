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
            'min_weight' => 'required|numeric|min:0',
            'max_weight' => 'required|numeric|gt:min_weight',
            'multiplier' => 'required|integer|min:1',
            'base_service_fee' => 'required|numeric|min:0',
            'region_id' => 'required|string|max:50',
            'is_active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'min_weight.required' => 'Minimum weight is required',
            'max_weight.required' => 'Maximum weight is required',
            'max_weight.gt' => 'Maximum weight must be greater than minimum weight',
            'multiplier.required' => 'Multiplier is required',
            'multiplier.min' => 'Multiplier must be at least 1',
            'base_service_fee.required' => 'Base service fee is required',
        ];
    }
}
