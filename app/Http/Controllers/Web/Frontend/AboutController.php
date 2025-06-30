<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\CampaignRepositoryInterface;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    private CampaignRepositoryInterface $campaignRepository;

    public function __construct(CampaignRepositoryInterface $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    public function index()
    {
        $campaigns = $this->campaignRepository->getCampaignsByStatus('verified', 10);

        return view('pages.frontend.about.profil', compact('campaigns'));
    }
}
