<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\CampaignCategoryRepositoryInterface;
use App\Interfaces\CampaignRepositoryInterface;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    private CampaignRepositoryInterface $campaignRepository;
    private CampaignCategoryRepositoryInterface $categoryRepository;

    public function __construct(CampaignRepositoryInterface $campaignRepository, CampaignCategoryRepositoryInterface $categoryRepository)
    {
        $this->campaignRepository = $campaignRepository;
        $this->categoryRepository = $categoryRepository;
    }


    public function index(Request $request)
    {
        $campaigns = $this->campaignRepository->getCampaignsByStatus('verified', 10, request()->category, request()->search, 'campaign');
        $categories  = $this->categoryRepository->getAllCampaignCategories();

        return view('pages.frontend.campaign.index', compact('campaigns', 'categories'));
    }

    public function show(Campaign $campaign)
    {
        $donations = $campaign->donations()->latest()->where('status', 'success')->paginate(6);

        // dd($donations);


        return view('pages.frontend.campaign.show', compact('campaign', 'donations'));
    }
}
