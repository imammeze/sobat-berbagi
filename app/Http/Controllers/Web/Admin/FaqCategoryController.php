<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Faq\StoreFaqCategoryRequest;
use App\Http\Requests\Web\Admin\Faq\UpdateFaqCategoryRequest;
use App\Interfaces\FaqCategoryRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class FaqCategoryController extends Controller
{
    private FaqCategoryRepositoryInterface $faqCategoryRepository;

    public function __construct(FaqCategoryRepositoryInterface $faqCategoryRepository)
    {
        $this->faqCategoryRepository = $faqCategoryRepository;

        $this->middleware(['permission:faq-category-list'], ['only' => ['index']]);
        $this->middleware(['permission:faq-category-create'], ['only' => ['store']]);
        $this->middleware(['permission:faq-category-edit'], ['only' => ['update']]);
        $this->middleware(['permission:faq-category-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->faqCategoryRepository->getAllFaqCategories()->sortBy('created_at');

        return view('pages.admin.faq-management.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.faq-management.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaqCategoryRequest $request)
    {
        $this->faqCategoryRepository->createFaqCategory($request->all());

        Swal::toast('Berhasil menambahkan kategori FAQ', 'success');

        return redirect()->route('admin.faq-categories.index');
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
        $category = $this->faqCategoryRepository->getFaqCategoryById($id);

        return view('pages.admin.faq-management.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqCategoryRequest $request, string $id)
    {
        $this->faqCategoryRepository->updateFaqCategory($request->all(), $id);

        Swal::toast('Berhasil mengubah kategori FAQ', 'success');

        return redirect()->route('admin.faq-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->faqCategoryRepository->deleteFaqCategory($id);

        Swal::toast('Berhasil menghapus kategori FAQ', 'success');

        return redirect()->route('admin.faq-categories.index');
    }
}
