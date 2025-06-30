<?php

namespace App\Http\Requests\Web\Admin\Faq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreFaqCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:faq_categories,name'],
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
            'name.required' => 'Nama kategori wajib diisi.',
            'name.string' => 'Nama kategori harus berupa string.',
            'name.max' => 'Nama kategori maksimal 255 karakter.',
            'name.unique' => 'Nama kategori sudah terdaftar.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => Str::title($this->name),
            'slug' => Str::slug($this->name),
        ]);
    }
}
