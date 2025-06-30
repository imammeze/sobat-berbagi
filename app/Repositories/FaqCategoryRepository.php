<?php

namespace App\Repositories;

use App\Interfaces\FaqCategoryRepositoryInterface;
use App\Models\FaqCategory;

class FaqCategoryRepository implements FaqCategoryRepositoryInterface
{
    public function getAllFaqCategories()
    {
        return FaqCategory::all();
    }

    public function getFaqCategoryById(string $id)
    {
        return FaqCategory::find($id);
    }

    public function getFaqCategoryBySlug(string $slug)
    {
        return FaqCategory::where('slug', $slug)->first();
    }

    public function createFaqCategory(array $data)
    {
        return FaqCategory::create($data);
    }

    public function updateFaqCategory(array $data, string $id)
    {
        return FaqCategory::find($id)->update($data);
    }

    public function deleteFaqCategory(string $id)
    {
        return FaqCategory::destroy($id);
    }
}
