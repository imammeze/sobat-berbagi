<?php

namespace App\Interfaces;

interface NewsRepositoryInterface
{
    public function getAllNews($paginate = null);
    public function getLatestNews();
    public function getNewsById(string $id);
    public function getNewsBySlug(string $slug);
    public function createNews(array $data);
    public function updateNews(array $data, string $id);
    public function deleteNews(string $id);
}
