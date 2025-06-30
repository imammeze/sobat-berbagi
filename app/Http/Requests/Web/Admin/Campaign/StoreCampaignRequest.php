<?php

namespace App\Http\Requests\Web\Admin\Campaign;

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
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'end_date' => 'required|date',
            'campaign_category_id' => 'required|exists:campaign_categories,id',
            'mitra_id' => 'required|exists:mitras,id',
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
            'mitra_id.required' => 'Mitra tidak boleh kosong',
            'slug.required' => 'Slug tidak boleh kosong',
        ];
    }
}
