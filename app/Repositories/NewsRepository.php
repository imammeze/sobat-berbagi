<?php

namespace App\Repositories;


use App\Interfaces\NewsRepositoryInterface;
use App\Models\Article;
use Illuminate\Support\Str;

class NewsRepository implements NewsRepositoryInterface
{
    public function getAllNews($paginate = null)
    {
        if ($paginate) {
            return Article::latest()->paginate($paginate);
        }

        return Article::latest()->get();
    }


    public function getLatestNews()
    {
        return Article::latest()->take(3)->get();
    }

    public function getNewsById(string $id)
    {
        return Article::findOrFail($id);
    }

    public function getNewsBySlug(string $slug)
    {
        return Article::where('slug', $slug)->firstOrFail();
    }

    public function createNews(array $data)
    {
        $news = Article::create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'thumbnail' => $data['thumbnail'],
        ]);

        $news->tags()->attach($data['tags']);
        $news->categories()->attach($data['categories']);

        return $news;
    }

    public function updateNews(array $data, string $id)
    {
        $news = $this->getNewsById($id);

        return $news->update($data);
    }

    public function deleteNews(string $id)
    {
        $news = $this->getNewsById($id);
        return $news->delete();
    }
}
