<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\NewsRepositoryInterface;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private NewsRepositoryInterface $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = $this->newsRepository->getAllNews(6);

        return view('pages.frontend.news.index', compact('news'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $news = $this->newsRepository->getNewsBySlug($slug);
        $latestNews = $this->newsRepository->getLatestNews();


        return view('pages.frontend.news.show', compact('news', 'latestNews'));
    }
}
