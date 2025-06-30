<?php

namespace App\Repositories;

use App\Interfaces\NewsCategoryRepositoryInterface;
use App\Models\ArticleCategory;
use App\Models\NewsCategory;
use Illuminate\Support\Str;

class NewsCategoryRepository implements NewsCategoryRepositoryInterface
{
    public function getAllNewsCategories()
    {
        return ArticleCategory::all();
    }


    public function getNewsCategoryById(string $id)
    {
        return ArticleCategory::findOrFail($id);
    }

    public function createNewsCategory(array $data)
    {
        $slug = Str::slug($data['name']);

        $data['slug'] = $slug;

        return ArticleCategory::create($data);
    }

    public function updateNewsCategory(array $data, string $id)
    {
        $newsCategory = $this->getNewsCategoryById($id);

        $slug = Str::slug($data['name']);

        $data['slug'] = $slug;

        return $newsCategory->update($data);
    }

    public function deleteNewsCategory(string $id)
    {
        $newsCategory = $this->getNewsCategoryById($id);
        return $newsCategory->delete();
    }
}
