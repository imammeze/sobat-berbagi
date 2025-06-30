<?php

namespace App\Http\Requests\Web\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'proof' => 'nullable|image|max:2048',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'proof.required' => 'Bukti pembayaran tidak boleh kosong',
            'proof.image' => 'Bukti pembayaran harus berupa gambar',
            'proof.max' => 'Ukuran bukti pembayaran maksimal 2MB',
        ];
    }
}
