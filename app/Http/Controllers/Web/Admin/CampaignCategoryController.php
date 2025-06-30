<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Campaign\StoreCampaignCategoryRequest;
use App\Http\Requests\Web\Admin\Campaign\UpdateCampaignCategoryRequest;
use App\Interfaces\CampaignCategoryRepositoryInterface;
use App\Repositories\CampaignCategoryRepository;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class CampaignCategoryController extends Controller
{
    private CampaignCategoryRepositoryInterface $campaignCategoryRepository;

    public function __construct(CampaignCategoryRepositoryInterface $campaignCategoryRepository)
    {
        $this->campaignCategoryRepository = $campaignCategoryRepository;

        $this->middleware(['permission:campaign-category-list'], ['only' => ['index']]);
        $this->middleware(['permission:campaign-category-create'], ['only' => ['store']]);
        $this->middleware(['permission:campaign-category-edit'], ['only' => ['update']]);
        $this->middleware(['permission:campaign-category-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->campaignCategoryRepository->getAllCampaignCategories();

        return view('pages.admin.campaign-management.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.campaign-management.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampaignCategoryRequest $request)
    {
        $this->campaignCategoryRepository->createCampaignCategory($request->all());

        Swal::toast('Kategori campaign berhasil ditambahkan', 'success');

        return redirect()->route('admin.campaign-categories.index');
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
        $category = $this->campaignCategoryRepository->getCampaignCategoryById($id);

        return view('pages.admin.campaign-management.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCampaignCategoryRequest $request, string $id)
    {
        $this->campaignCategoryRepository->updateCampaignCategory($request->all(), $id);

        Swal::toast('Kategori campaign berhasil diperbarui', 'success');

        return redirect()->route('admin.campaign-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->campaignCategoryRepository->deleteCampaignCategory($id);

        Swal::toast('Kategori campaign berhasil dihapus', 'success');

        return redirect()->route('admin.campaign-categories.index');
    }
}
