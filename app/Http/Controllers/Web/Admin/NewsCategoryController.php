<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\News\StoreNewsCategoryRequest;
use App\Http\Requests\Web\Admin\News\UpdateNewsCategoryRequest;
use App\Interfaces\NewsCategoryRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class NewsCategoryController extends Controller
{

    private NewsCategoryRepositoryInterface $categoryRepository;

    public function __construct(NewsCategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;

        $this->middleware(['permission:article-category-list'], ['only' => ['index']]);
        $this->middleware(['permission:article-category-create'], ['only' => ['store']]);
        $this->middleware(['permission:article-category-edit'], ['only' => ['update']]);
        $this->middleware(['permission:article-category-delete'], ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryRepository->getAllNewsCategories();

        return view('pages.admin.news-management.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.news-management.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsCategoryRequest $request)
    {
        $this->categoryRepository->createNewsCategory($request->all());

        Swal::toast('Data berhasil ditambahkan', 'success');

        return redirect()->route('admin.news-categories.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->categoryRepository->getNewsCategoryById($id);

        return view('pages.admin.news-management.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsCategoryRequest $request, string $id)
    {

        $this->categoryRepository->updateNewsCategory($request->all(), $id);

        Swal::toast('Data berhasil diubah', 'success');

        return redirect()->route('admin.news-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->categoryRepository->deleteNewsCategory($id);

        Swal::toast('Data berhasil dihapus', 'success');

        return redirect()->route('admin.news-categories.index');
    }
}
