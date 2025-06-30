<?php

namespace App\Http\Requests\Web\Admin\Team;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'position' => 'required|string|max:255',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'name.string' => 'Nama harus berupa string',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'description.string' => 'Deskripsi harus berupa string',
            'description.max' => 'Deskripsi tidak boleh lebih dari 255 karakter',
            'image.required' => 'Gambar tidak boleh kosong',
            'image.image' => 'Gambar harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa jpeg,png,jpg,gif,svg',
            'image.max' => 'Gambar tidak boleh lebih dari 2048 kb',
            'position.required' => 'Posisi tidak boleh kosong',
            'position.string' => 'Posisi harus berupa string',
            'position.max' => 'Posisi tidak boleh lebih dari 255 karakter',
        ];
    }
}
