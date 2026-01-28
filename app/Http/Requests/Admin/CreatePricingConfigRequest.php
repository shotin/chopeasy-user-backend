<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreatePricingConfigRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Add authorization logic as needed
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'base_charge' => 'required|numeric|min:0',
            'service_charge' => 'required|numeric|min:0',
            'charge_per_distance' => 'required|numeric|min:0',
            'referral_bonus_percentage' => 'nullable|numeric|min:0|max:100',
            'region_id' => 'required|string|max:50',
            'is_active' => 'boolean',
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Configuration name is required',
            'base_charge.required' => 'Base charge is required',
            'base_charge.min' => 'Base charge must be at least 0',
            'service_charge.required' => 'Service charge per item is required',
            'charge_per_distance.required' => 'Charge per distance is required',
            'region_id.required' => 'Region ID is required',
        ];
    }
}
