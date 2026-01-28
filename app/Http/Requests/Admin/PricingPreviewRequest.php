<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PricingPreviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'scenarios' => 'required|array|min:1',
            'scenarios.*.item_count' => 'required|integer|min:1',
            'scenarios.*.total_weight' => 'required|numeric|min:0.1',
            'scenarios.*.distance_km' => 'required|numeric|min:0.1',
            'scenarios.*.vendor_subtotal' => 'nullable|numeric|min:0',
            'region_id' => 'nullable|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'scenarios.required' => 'At least one scenario is required',
            'scenarios.*.item_count.required' => 'Item count is required for each scenario',
            'scenarios.*.total_weight.required' => 'Total weight is required for each scenario',
            'scenarios.*.distance_km.required' => 'Distance is required for each scenario',
        ];
    }
}
