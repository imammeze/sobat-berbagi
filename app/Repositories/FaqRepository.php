<?php

namespace App\Repositories;

use App\Interfaces\FaqRepositoryInterface;
use App\Models\Faq;

class FaqRepository implements FaqRepositoryInterface
{
    public function getAllFaqs()
    {
        return Faq::all();
    }

    public function getFaqById(string $id)
    {
        return Faq::find($id);
    }

    public function createFaq(array $data)
    {
        return Faq::create($data);
    }

    public function updateFaq(array $data, string $id)
    {
        return Faq::find($id)->update($data);
    }

    public function deleteFaq(string $id)
    {
        return Faq::destroy($id);
    }
}
