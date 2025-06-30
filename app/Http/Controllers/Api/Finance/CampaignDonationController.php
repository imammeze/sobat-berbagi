<?php

namespace App\Http\Controllers\Api\Finance;

use App\Http\Controllers\Controller;
use App\Interfaces\CampaignDonationRepositoryInterface;
use Illuminate\Http\Request;

class CampaignDonationController extends Controller
{
    private CampaignDonationRepositoryInterface $campaignDonationRepository;

    public function __construct(CampaignDonationRepositoryInterface $campaignDonationRepository)
    {
        $this->campaignDonationRepository = $campaignDonationRepository;
    }

    public function getAllCampaignDonationsPending()
    {
        $campaignDonations = $this->campaignDonationRepository->getCampaignDonationByStatus('pending');

        return response()->json([
            'status' => 'success',
            'data' => $campaignDonations
        ]);
    }
}
