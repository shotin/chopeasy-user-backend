<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'title' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|unique:blogs,slug,' . $id,
            'author_name' => 'sometimes|string|max:255',
            'content' => 'sometimes',
            'image' => 'required|string',
            'status' => 'in:draft,published',
            'published_at' => 'nullable|date',
        ];
    }
}
