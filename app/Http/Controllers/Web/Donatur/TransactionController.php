<?php

namespace App\Http\Controllers\Web\Donatur;

use App\Http\Controllers\Controller;
use App\Interfaces\CampaignDonationRepositoryInterface;
use App\Models\ZakatTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private CampaignDonationRepositoryInterface $campaignDonationRepository;

    public function __construct(CampaignDonationRepositoryInterface $campaignDonationRepository)
    {
        $this->campaignDonationRepository = $campaignDonationRepository;
    }

    public function index()
    {
        $campaignDonations = $this->campaignDonationRepository->getCampaignDonationByUserId(auth()->user()->id);

        $zakatTransactions = ZakatTransaction::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        $campaignDonations = $campaignDonations->merge($zakatTransactions);

        return view('pages.donatur.transaction.index', compact('campaignDonations'));
    }
}
