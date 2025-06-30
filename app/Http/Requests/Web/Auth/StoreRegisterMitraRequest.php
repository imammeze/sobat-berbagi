<?php

namespace App\Http\Requests\Web\Auth;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterMitraRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
            'name' => 'required|string|max:255|unique:mitras,name',
            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:mitras,slug',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^[a-z]+$/', $value) || strpos($value, ' ') !== false) {
                        $fail($attribute . ' hanya boleh huruf kecil dan tanpa spasi.');
                    }
                },
            ],
            'logo' => 'required', 'image', 'max:2048',
            'description' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'pic_name' => 'required|string',
            'identity_number' =>    'required|string',
            'identity_file' => 'required', 'image', 'max:2048',
            'identity_file_handheld' => 'required', 'image', 'max:2048',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
            'name' => 'Nama',
            'slug' => 'Username',
            'logo' => 'Logo',
            'description' => 'Deskripsi',
            'address' => 'Alamat',
            'phone' => 'Nomor Telepon',
            'pic_name' => 'Nama Penanggung Jawab',
            'identity_number' => 'Nomer Induk Kependudukan',
            'identity_file' => 'Foto KTP',
            'identity_file_handheld' => 'Foto Selfie Bersama KTP',
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
            'email.required' => ':attribute tidak boleh kosong.',
            'email.email' => ':attribute harus berupa email.',
            'email.unique' => ':attribute sudah terdaftar.',
            'password.required' => ':attribute tidak boleh kosong.',
            'name.required' => ':attribute tidak boleh kosong.',
            'name.unique' => ':attribute sudah terdaftar.',
            'username.required' => ':attribute tidak boleh kosong.',
            'username.unique' => ':attribute sudah terdaftar.',
            'logo.required' => ':attribute tidak boleh kosong.',
            'description.required' => ':attribute tidak boleh kosong.',
            'address.required' => ':attribute tidak boleh kosong.',
            'phone.required' => ':attribute tidak boleh kosong.',
            'pic_name.required' => ':attribute tidak boleh kosong.',
            'identity_number.required' => ':attribute tidak boleh kosong.',
            'identity_file.required' => ':attribute tidak boleh kosong.',
            'identity_file_handheld.required' => ':attribute tidak boleh kosong.',
            'image' => ':attribute harus berupa gambar.',
            'max' => ':attribute maksimal 2MB.',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'logo' => $this->logo,
            'identity_file' => $this->identity_file,
            'identity_file_handheld' => $this->identity_file_handheld,
        ]);
    }
}
