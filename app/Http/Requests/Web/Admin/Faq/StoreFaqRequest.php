<?php

namespace App\Http\Requests\Web\Admin\Faq;

use Illuminate\Foundation\Http\FormRequest;

class StoreFaqRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
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
            'faq_category_id.required' => 'Kategori wajib diisi.',
            'faq_category_id.exists' => 'Kategori tidak ditemukan.',
            'question.required' => 'Pertanyaan wajib diisi.',
            'question.string' => 'Pertanyaan harus berupa string.',
            'question.max' => 'Pertanyaan maksimal 255 karakter.',
            'answer.required' => 'Jawaban wajib diisi.',
            'answer.string' => 'Jawaban harus berupa string.',
        ];
    }
}
