<?php

namespace App\Http\Requests\Web\Mitra;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'story' => 'required|string',
            'target' => 'required|numeric',
            'thumbnail' => 'required|image|mimes:jpeg,jpg,png,gif,svg,avif|max:5000',
            'end_date' => 'required|date',
            'campaign_category_id' => 'required|exists:campaign_categories,id',
            'slug' => 'required|string',
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
            'title.required' => 'Judul tidak boleh kosong',
            'story.required' => 'Cerita tidak boleh kosong',
            'target.required' => 'Target tidak boleh kosong',
            'thumbnail.required' => 'Thumbnail tidak boleh kosong',
            'end_date.required' => 'Tanggal berakhir tidak boleh kosong',
            'campaign_category_id.required' => 'Kategori tidak boleh kosong',
            'slug.required' => 'Slug tidak boleh kosong',
            'thumbnail.image' => 'File harus berupa gambar',
            'thumbnail.mimes' => 'File harus bertipe jpeg,jpg,png,gif,svg,avif',
            'thumbnail.max' => 'File maksimal 5 MB',
            'target.numeric' => 'Target harus berupa angka',
            'campaign_category_id.exists' => 'Kategori tidak ditemukan',
            'slug.string' => 'Slug harus berupa string',
            'slug.max' => 'Slug maksimal 255 karakter',
            'slug.unique' => 'Slug sudah ada',
        ];
    }
}
