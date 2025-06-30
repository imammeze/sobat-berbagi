<?php

namespace App\Http\Requests\Web\Admin\Banners;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'desktop_image' => 'required',
            'mobile_image' => 'required',
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
            'desktop_image.required' => 'Gambar desktop tidak boleh kosong',
            'mobile_image.required' => 'Gambar mobile tidak boleh kosong',
        ];
    }
}
