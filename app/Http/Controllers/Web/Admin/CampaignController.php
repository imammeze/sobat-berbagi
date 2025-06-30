<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Campaign\StoreCampaignRequest;
use App\Interfaces\CampaignCategoryRepositoryInterface;
use App\Interfaces\CampaignImageRepositoryInterface;
use App\Interfaces\CampaignRepositoryInterface;
use App\Interfaces\MitraRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class CampaignController extends Controller
{
    private CampaignImageRepositoryInterface $campaignImageRepository;
    private CampaignRepositoryInterface $campaignRepository;
    private CampaignCategoryRepositoryInterface $campaignCategoryRepository;
    private MitraRepositoryInterface $mitraRepository;

    public function __construct(
        CampaignImageRepositoryInterface $campaignImageRepository,
        CampaignRepositoryInterface $campaignRepository,
        CampaignCategoryRepositoryInterface $campaignCategoryRepository,
        MitraRepositoryInterface $mitraRepository
    ) {
        $this->campaignImageRepository = $campaignImageRepository;
        $this->campaignRepository = $campaignRepository;
        $this->campaignCategoryRepository = $campaignCategoryRepository;
        $this->mitraRepository = $mitraRepository;

        $this->middleware(['permission:campaign-list'], ['only' => ['index']]);
        $this->middleware(['permission:campaign-create'], ['only' => ['store']]);
        $this->middleware(['permission:campaign-edit'], ['only' => ['update']]);
        $this->middleware(['permission:campaign-delete'], ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campaigns = $this->campaignRepository->getAllCampaigns();

        return view('pages.admin.campaign-management.campaign.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->campaignCategoryRepository->getAllCampaignCategories();
        $mitras = $this->mitraRepository->getAllMitra();
        $types = [
            ['id' => 'campaign', 'name' => 'Campaign'],
            ['id' => 'event', 'name' => 'Event']
        ];
        $fix_amount = [
            ['id' => '0', 'name' => 'Tidak'],
            ['id' => '1', 'name' => 'Ya']
        ];

        return view('pages.admin.campaign-management.campaign.create', compact('categories', 'mitras', 'types', 'fix_amount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampaignRequest $request)
    {
        $this->campaignRepository->createCampaign($request->all());

        if (Auth::user()->hasRole('mitra')) {
            Swal::toast('Campaign berhasil ditambahkan, tunggu admin untuk memverivikasi campaign', 'success');
        } else {
            Swal::toast('Campaign berhasil ditambahkan', 'success');
        }

        return redirect()->route('admin.campaigns.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $campaign = $this->campaignRepository->getCampaignById($id);

        return view('pages.admin.campaign-management.campaign.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $campaign = $this->campaignRepository->getCampaignById($id);
        $categories = $this->campaignCategoryRepository->getAllCampaignCategories();
        $mitras = $this->mitraRepository->getAllMitra();
        $types = [
            ['id' => 'campaign', 'name' => 'Campaign'],
            ['id' => 'event', 'name' => 'Event']
        ];
        $fix_amount = [
            ['id' => '0', 'name' => 'Tidak'],
            ['id' => '1', 'name' => 'Ya']
        ];


        return view('pages.admin.campaign-management.campaign.edit', compact('campaign', 'categories', 'mitras', 'types', 'fix_amount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->campaignRepository->updateCampaign($request->all(), $id);

        Swal::toast('Campaign berhasil diupdate', 'success');

        return redirect()->route('admin.campaigns.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->campaignRepository->deleteCampaign($id);

        Swal::toast('Campaign berhasil dihapus', 'success');

        return redirect()->route('admin.campaigns.index');
    }

    public function featured($id)
    {
        $campaign = $this->campaignRepository->getCampaignById($id);

        $campaign->is_featured = !$campaign->is_featured;

        $campaign->save();

        return response()->json([
            'message' => $campaign->is_featured ? 'Campaign berhasil dipromosikan' : 'Campaign berhasil di unpromosikan',
        ]);
    }

    public function verified($id)
    {
        $campaign = $this->campaignRepository->getCampaignById($id);

        $campaign->status = 'verified';

        $campaign->save();

        return response()->json([
            'message' => 'Campaign berhasil diverivikasi',
        ]);
    }
}
