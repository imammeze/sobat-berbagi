<?php

namespace App\Repositories;

use App\Interfaces\CampaignDonationRepositoryInterface;
use App\Models\Campaign;
use App\Models\CampaignDonation;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;

class CampaignDonationRepository implements CampaignDonationRepositoryInterface
{

    public function getAllCampaignDonations()
    {
        if (Auth::user()->hasRole('mitra')) {
            return CampaignDonation::whereHas('campaign', function ($query) {
                $query->where('mitra_id', Auth::user()->profile->id);
            })->orderBy('created_at', 'desc')->get();
        } else {
            return CampaignDonation::orderBy('created_at', 'desc')->get();
        }
    }

    public function getCampaignDonationById(string $id)
    {
        return CampaignDonation::find($id);
    }

    public function createCampaignDonation(array $data)
    {
        return CampaignDonation::create($data);
    }

    public function updateCampaignDonation(array $data, string $id)
    {
        return CampaignDonation::find($id)->update($data);
    }
    public function updateAmount(string $id, float $amount)
    {
        $campaignDonation = CampaignDonation::find($id);
        if (!$campaignDonation) {
            return false;
        }

        $campaignDonation->amount = $amount;
        return $campaignDonation->save();
    }

    public function deleteCampaignDonation(string $id)
    {
        return CampaignDonation::destroy($id);
    }

    public function getCampaignDonationByUserId(string $id)
    {
        return CampaignDonation::where('user_id', $id)->orderBy('created_at', 'desc')->get();
    }

    public function getCampaignDonationByMitraId(string $id)
    {
        return CampaignDonation::whereHas('campaign', function ($query) use ($id) {
            $query->where('mitra_id', $id);
        })->get();
    }

    public function getCampaignDonationByStatus(string $status, string $isQr = null)
    {
        $paymentMethod = PaymentMethod::where('code', 'qris')->first();


        if ($isQr) {
            return CampaignDonation::where('status', $status)->where('payment_method_id', $paymentMethod->id)->with('campaign')->get();
        }

        return CampaignDonation::where('status', $status)->where('payment_method_id', '!=', $paymentMethod->id)->with('campaign')->get();
    }
}
