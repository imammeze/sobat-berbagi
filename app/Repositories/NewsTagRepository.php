<?php

namespace App\Repositories;

use App\Interfaces\NewsTagRepositoryInterface;
use App\Models\ArticleTag;
use App\Models\NewsTag;
use App\Models\NewsTags;
use Illuminate\Support\Str;

class NewsTagRepository implements NewsTagRepositoryInterface
{
    public function getAllNewsTags()
    {
        return ArticleTag::all();
    }

    public function getNewsTagById(string $id)
    {
        return ArticleTag::findOrFail($id);
    }

    public function createNewsTag(array $data)
    {
        $slug = Str::slug($data['name']);

        $data['slug'] = $slug;

        return ArticleTag::create($data);
    }


    public function updateNewsTag(array $data, string $id)
    {
        $newsTag = $this->getNewsTagById($id);

        $slug = Str::slug($data['name']);

        $data['slug'] = $slug;

        return $newsTag->update($data);
    }

    public function deleteNewsTag(string $id)
    {
        $newsTag = $this->getNewsTagById($id);
        return $newsTag->delete();
    }
}
