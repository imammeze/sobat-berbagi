<?php

namespace App\Http\Requests\Web\Admin\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentMethodRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'logo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'number' => 'required|string',
            'owner' => 'required|string',
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
            'name.required' => 'Nama metode pembayaran tidak boleh kosong.',
            'logo.required' => 'Logo metode pembayaran tidak boleh kosong.',
            'logo.image' => 'Logo metode pembayaran harus berupa gambar.',
            'logo.mimes' => 'Logo metode pembayaran harus berupa gambar dengan format jpg, jpeg, atau png.',
            'logo.max' => 'Logo metode pembayaran tidak boleh lebih dari 2MB.',
            'number.required' => 'Nomor rekening tidak boleh kosong.',
            'owner.required' => 'Nama pemilik rekening tidak boleh kosong.',
        ];
    }
}
