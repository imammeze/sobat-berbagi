<?php

namespace App\Http\Requests\Web\Admin\News;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:news_categories,name',
            'slug' => 'required|string|max:255|unique:news_categories,slug',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori wajib diisi',
            'name.string' => 'Nama kategori harus berupa string',
            'name.max' => 'Nama kategori maksimal 255 karakter',
            'name.unique' => 'Nama kategori sudah ada',
            'slug.required' => 'Slug wajib diisi',
            'slug.string' => 'Slug harus berupa string',
            'slug.max' => 'Slug maksimal 255 karakter',
            'slug.unique' => 'Slug sudah ada',
            'description.string' => 'Deskripsi harus berupa string',
        ];
    }
}
