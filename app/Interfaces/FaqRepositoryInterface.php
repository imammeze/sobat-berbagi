<?php

namespace App\Interfaces;

interface FaqRepositoryInterface
{
    public function getAllFaqs();

    public function getFaqById(string $id);

    public function createFaq(array $data);

    public function updateFaq(array $data, string $id);

    public function deleteFaq(string $id);
}
