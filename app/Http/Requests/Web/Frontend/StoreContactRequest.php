<?php

namespace App\Http\Requests\Web\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'email', 'max:255', 'min:3'],
            'company' => ['required', 'string', 'max:255', 'min:3'],
            'phone' => ['required', 'string', 'max:255', 'min:3'],
            'message' => ['required', 'string', 'max:255', 'min:3'],
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
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama harus berupa string',
            'name.max' => 'Nama maksimal 255 karakter',
            'name.min' => 'Nama minimal 3 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus berupa email',
            'email.max' => 'Email maksimal 255 karakter',
            'email.min' => 'Email minimal 3 karakter',
            'company.required' => 'Perusahaan harus diisi',
            'company.string' => 'Perusahaan harus berupa string',
            'company.max' => 'Perusahaan maksimal 255 karakter',
            'company.min' => 'Perusahaan minimal 3 karakter',
            'phone.required' => 'Nomor telepon harus diisi',
            'phone.string' => 'Nomor telepon harus berupa string',
            'phone.max' => 'Nomor telepon maksimal 255 karakter',
            'phone.min' => 'Nomor telepon minimal 3 karakter',
            'message.required' => 'Pesan harus diisi',
            'message.string' => 'Pesan harus berupa string',
            'message.max' => 'Pesan maksimal 255 karakter',
            'message.min' => 'Pesan minimal 3 karakter',
        ];
    }
}
