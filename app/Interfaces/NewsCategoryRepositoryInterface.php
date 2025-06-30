<?php


namespace App\Interfaces;

interface NewsCategoryRepositoryInterface
{
    public function getAllNewsCategories();
    public function getNewsCategoryById(string $id);
    public function createNewsCategory(array $data);
    public function updateNewsCategory(array $data, string $id);
    public function deleteNewsCategory(string $id);
}
