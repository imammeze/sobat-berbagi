<?php

namespace App\Interfaces;

interface FaqCategoryRepositoryInterface
{
    public function getAllFaqCategories();
    public function getFaqCategoryById(string $id);
    public function getFaqCategoryBySlug(string $slug);
    public function createFaqCategory(array $data);
    public function updateFaqCategory(array $data, string $id);
    public function deleteFaqCategory(string $id);
}
