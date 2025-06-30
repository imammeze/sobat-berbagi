<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\BannerRepositoryInterface;
use App\Interfaces\CampaignRepositoryInterface;
use App\Interfaces\NewsRepositoryInterface;
use App\Models\News;
use Illuminate\Http\Request;

class LandingController extends Controller
{

    private BannerRepositoryInterface $bannerRepository;
    private CampaignRepositoryInterface $campaignRepository;
    private NewsRepositoryInterface $newsRepository;

    public function __construct(
        BannerRepositoryInterface $bannerRepository,
        CampaignRepositoryInterface $campaignRepository,
        NewsRepositoryInterface $newsRepository
    ) {
        $this->bannerRepository = $bannerRepository;
        $this->campaignRepository = $campaignRepository;
        $this->newsRepository = $newsRepository;
    }

    public function index()
    {

        $banners = $this->bannerRepository->getAllBanners();
        $news = $this->newsRepository->getLatestNews();
        $campaigns = $this->campaignRepository->getCampaignsByStatus('verified', 10, null, null, 'campaign');

        return view('index', compact('banners', 'news', 'campaigns'));
    }
}
