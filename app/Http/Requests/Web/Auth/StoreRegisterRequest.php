<?php

namespace App\Http\Requests\Web\Auth;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'phone_number' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
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
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 255 karakter',
            'phone_number.required' => 'Nomor telepon harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus berupa email',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.string' => 'Password harus berupa string',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 255 karakter',
        ];
    }
}
