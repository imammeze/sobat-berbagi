<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\FaqCategoryRepositoryInterface;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    private FaqCategoryRepositoryInterface $faqCategoryRepository;

    public function __construct(FaqCategoryRepositoryInterface $faqCategoryRepository)
    {
        $this->faqCategoryRepository = $faqCategoryRepository;
    }

    public function index()
    {
        $categories = $this->faqCategoryRepository->getAllFaqCategories()->sortBy('created_at');

        return view('pages.frontend.faq.index', compact('categories'));
    }
}
