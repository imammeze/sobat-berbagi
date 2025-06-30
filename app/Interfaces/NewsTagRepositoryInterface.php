<?php


namespace App\Interfaces;

interface NewsTagRepositoryInterface
{
    public function getAllNewsTags();
    public function getNewsTagById(string $id);
    public function createNewsTag(array $data);
    public function updateNewsTag(array $data, string $id);
    public function deleteNewsTag(string $id);
}
