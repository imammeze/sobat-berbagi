<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CampaignDonationRepositoryInterface;
use App\Interfaces\CampaignRepositoryInterface;
use App\Interfaces\PaymentMethodRepositoryInterface;
use App\Jobs\SendWhatsAppNotification;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class CampaignDonationController extends Controller
{
    private CampaignDonationRepositoryInterface $campaignDonationRepository;
    private CampaignRepositoryInterface $campaignRepository;
    private PaymentMethodRepositoryInterface $paymentMethodRepository;

    public function __construct(CampaignDonationRepositoryInterface $campaignDonationRepository, CampaignRepositoryInterface $campaignRepository, PaymentMethodRepositoryInterface $paymentMethodRepository)
    {
        $this->campaignDonationRepository = $campaignDonationRepository;
        $this->campaignRepository = $campaignRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;

        $this->middleware(['permission:campaign-donation-list'], ['only' => ['index']]);
        $this->middleware(['permission:campaign-donation-create'], ['only' => ['store']]);
        $this->middleware(['permission:campaign-donation-edit'], ['only' => ['update']]);
        $this->middleware(['permission:campaign-donation-delete'], ['only' => ['destroy']]);
        $this->middleware(['permission:campaign-donation-approve'], ['only' => ['approve']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paymentMethodCode = $request->payment_method_code;

        $paymentMethod = $this->paymentMethodRepository->getAllPaymentMethods();

        if ($paymentMethodCode == 'qris') {
            $campaignDonations =  $this->campaignDonationRepository->getAllCampaignDonations()->where('payment_method_id', '=', $paymentMethod->where('code', '=', 'qris')->first()->id);
        } else {
            $campaignDonations =  $this->campaignDonationRepository->getAllCampaignDonations()->where('payment_method_id', '!=', $paymentMethod->where('code', '=', 'qris')->first()->id);
        }

        return view('pages.admin.transaction-management.campaign-donation.index', compact('campaignDonations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $campaignDonation = $this->campaignDonationRepository->getCampaignDonationById($id);

        return view('pages.admin.transaction-management.campaign-donation.show', compact('campaignDonation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->campaignDonationRepository->updateCampaignDonation($request->all(), $id);

        Swal::toast('Campaign donation updated', 'success');

        return redirect()->route('admin.transaksi-campaign.index');
    }

    public function approve(string $id)
    {
        $campaignDonation = $this->campaignDonationRepository->getCampaignDonationById($id);

        $campaignDonation->update([
            'status' => 'success'
        ]);

        $campaign = $this->campaignRepository->getCampaignById($campaignDonation->campaign_id);

        $campaign->update([
            'raised' => $campaign->raised  + $campaignDonation->amount
        ]);

        $formattedAmount = number_format($campaignDonation->amount, 0, ',', '.');

        $donatur = $campaignDonation->user->donaturRelation->name;
        $phoneNumber = $campaignDonation->user->donaturRelation->phone_number;

        $message = "Terimakasih $donatur, telah berdonasi sebesar Rp. *{$formattedAmount}* untuk campaign *{$campaign->title}*." . PHP_EOL . PHP_EOL
            . "Teriring doa semoga Allah SWT memberikan pahala atas apa yang engkau berikan, menjadikan barokah atas apa yang masih ada ditangganmu dan menjadikan pembersih dosa bagimu Aamiin Yaa Rabbal Allamin." . PHP_EOL . PHP_EOL
            . "Sobat Berbagi," . PHP_EOL . "Lazismu Banyumas";

        SendWhatsAppNotification::dispatch($phoneNumber, $message);

        Swal::toast('Donasi campaign diterima', 'success');

        return redirect()->route('admin.transaksi-campaign.index');
    }
}
