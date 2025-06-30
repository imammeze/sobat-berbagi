<?php

namespace App\Http\Requests\Web\Admin\News;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'slug' => 'required|string|unique:news,slug',
            'thumbnail' => 'nullable|image',
            'content' => 'nullable|string',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Title wajib diisi',
            'title.string' => 'Title harus berupa string',
            'slug.required' => 'Slug wajib diisi',
            'slug.string' => 'Slug harus berupa string',
            'slug.unique' => 'Slug sudah digunakan',
            'thumbnail.image' => 'Thumbnail harus berupa gambar',
            'content.string' => 'Content harus berupa string',
        ];
    }
}
