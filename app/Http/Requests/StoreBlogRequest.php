<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:blogs',
            'author_name' => 'nullable|string|max:255',
            'content' => 'required',
            'image' => 'required|string',
            'status' => 'in:draft,published',
            'published_at' => 'nullable|date',
        ];
    }
}
