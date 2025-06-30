<?php

namespace App\Http\Requests\Web\Mitra;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'required|confirmed|min:8'
        ];
    }

    public function attributes(): array
    {
        return [
            'password' => 'Password Baru',
            'password_confirmation' => 'Konfirmasi Password Baru'
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => ':attribute tidak boleh kosong',
            'password.confirmed' => ':attribute dan Konfirmasi Password Baru tidak sama',
            'password.min' => ':attribute minimal 8 karakter'
        ];
    }
}
