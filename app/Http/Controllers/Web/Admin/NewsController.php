<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\News\StoreNewsRequest;
use App\Interfaces\NewsCategoryRepositoryInterface;
use App\Interfaces\NewsRepositoryInterface;
use App\Interfaces\NewsTagRepositoryInterface;
use App\Models\News;
use App\Models\NewsTag;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class NewsController extends Controller
{
    private NewsRepositoryInterface $newsRepository;
    private NewsCategoryRepositoryInterface $newsCategoryRepository;
    private NewsTagRepositoryInterface $newsTagRepository;

    public function __construct(
        NewsRepositoryInterface $newsRepository,
        NewsCategoryRepositoryInterface $newsCategoryRepository,
        NewsTagRepositoryInterface $newsTagRepository
    ) {
        $this->newsRepository = $newsRepository;
        $this->newsCategoryRepository = $newsCategoryRepository;
        $this->newsTagRepository = $newsTagRepository;

        $this->middleware(['permission:article-list'], ['only' => ['index']]);
        $this->middleware(['permission:article-create'], ['only' => ['store']]);
        $this->middleware(['permission:article-edit'], ['only' => ['update']]);
        $this->middleware(['permission:article-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = $this->newsRepository->getAllNews();


        return view('pages.admin.news-management.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->newsCategoryRepository->getAllNewsCategories();
        $tags = $this->newsTagRepository->getAllNewsTags();

        return view('pages.admin.news-management.news.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $this->newsRepository->createNews($request->all());

        Swal::toast('Berita berhasil ditambahkan', 'success');

        return redirect()->route('admin.news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = $this->newsRepository->getNewsById($id);
        $categories = $this->newsCategoryRepository->getAllNewsCategories();
        $tags = $this->newsTagRepository->getAllNewsTags();

        return view('pages.admin.news-management.news.edit', compact('news', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->newsRepository->updateNews($request->all(), $id);

        Swal::toast('Berita berhasil diperbarui', 'success');

        return redirect()->route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->newsRepository->deleteNews($id);

            Swal::toast('Berita berhasil dihapus', 'success');

            return redirect()->route('admin.news.index');
        } catch (\Throwable $th) {
            return redirect()->route('admin.news.index')->with('error', 'Gagal menghapus berita');
        }
    }
}
