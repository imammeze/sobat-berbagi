<?php

namespace App\Http\Requests\Web\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class StoreZakatMaalRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules =  [
            'amount' => 'required|numeric|min:100',
            'message' => 'nullable|string',
            'is_anonymous' => 'nullable|boolean',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ];

        if (auth()->guest()) {
            $rules['name'] = 'required';
            $rules['email'] = 'required|email';
            $rules['phone_number'] = 'required';
            $rules['address'] = 'required';
        }

        return $rules;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'amount.required' => 'Jumlah donasi tidak boleh kosong',
            'amount.numeric' => 'Jumlah donasi harus berupa angka',
            'amount.min' => 'Jumlah donasi minimal Rp. 100',
            'payment_method_id.required' => 'Pilih metode pembayaran',
            'payment_method_id.exists' => 'Metode pembayaran tidak valid',
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'phone_number.required' => 'Nomor telepon harus diisi',
            'address.required' => 'Alamat harus diisi',
        ];
    }
}
