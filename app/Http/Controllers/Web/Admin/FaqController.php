<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Faq\StoreFaqRequest;
use App\Http\Requests\Web\Admin\Faq\UpdateFaqRequest;
use App\Interfaces\FaqCategoryRepositoryInterface;
use App\Interfaces\FaqRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class FaqController extends Controller
{
    private FaqRepositoryInterface $faqRepository;
    private FaqCategoryRepositoryInterface $faqCategoryRepository;

    public function __construct(FaqRepositoryInterface $faqRepository, FaqCategoryRepositoryInterface $faqCategoryRepository)
    {
        $this->faqRepository = $faqRepository;
        $this->faqCategoryRepository = $faqCategoryRepository;

        $this->middleware(['permission:faq-list'], ['only' => ['index']]);
        $this->middleware(['permission:faq-create'], ['only' => ['store']]);
        $this->middleware(['permission:faq-edit'], ['only' => ['update']]);
        $this->middleware(['permission:faq-delete'], ['only' => ['destroy']]);
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = $this->faqRepository->getAllFaqs();

        return view('pages.admin.faq-management.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->faqCategoryRepository->getAllFaqCategories();

        return view('pages.admin.faq-management.faq.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaqRequest $request)
    {
        $this->faqRepository->createFaq($request->all());

        Swal::toast('Berhasil menambahkan pertanyaan baru', 'success');

        return redirect()->route('admin.faqs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faq = $this->faqRepository->getFaqById($id);

        $categories = $this->faqCategoryRepository->getAllFaqCategories();

        return view('pages.admin.faq-management.faq.edit', compact('faq', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqRequest $request, string $id)
    {
        $this->faqRepository->updateFaq($request->all(), $id);

        Swal::toast('Berhasil mengubah pertanyaan', 'success');

        return redirect()->route('admin.faqs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->faqRepository->deleteFaq($id);

        Swal::toast('Berhasil menghapus pertanyaan', 'success');

        return redirect()->route('admin.faqs.index');
    }
}
