<?php

namespace App\Http\Requests\Web\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules =  [
            'amount' => 'required|numeric|min:1',
            'message' => 'nullable|string',
            'is_anonymous' => 'nullable',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ];

        if (auth()->guest()) {
            $rules['name'] = 'required';
            $rules['email'] = 'required|email|unique:users,email';
            $rules['phone_number'] = 'required|unique:donaturs,phone_number';
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'amount' => 'Jumlah Donasi',
            'message' => 'Pesan',
            'is_anonymous' => 'Anonim',
            'payment_method_id' => 'Metode Pembayaran',
            'name' => 'Nama',
            'email' => 'Email',
            'phone_number' => 'Nomor Telepon',
        ];
    }
    public function messages(): array
    {
        return [
            'amount.required' => 'Jumlah donasi tidak boleh kosong',
            'amount.min' => 'Jumlah donasi minimal Rp. :min',
            'payment_method_id.required' => 'Metode pembayaran tidak boleh kosong',
            'payment_method_id.exists' => 'Metode pembayaran tidak ditemukan',
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'phone_number.required' => 'Nomor telepon tidak boleh kosong',
            'phone_number.unique' => 'Nomor telepon sudah terdaftar',
        ];
    }
}
