<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Models\CampaignDonation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignDonationController extends Controller
{
    public function getAllCampaignDonations(Request $request)
    {
        $currentYear = Carbon::now()->year;

        $campaignDonations = CampaignDonation::whereYear('created_at', $currentYear)->get();

        $groupedDonations = $campaignDonations->groupBy(function ($donation) {
            return $donation->created_at->format('F');
        })->map(function ($donations) {
            return $donations->filter(function ($donation) {
                return $donation->status === 'success';
            })->sum('amount');
        });

        $groupedDonations = collect($groupedDonations)->sortBy(function ($value, $key) {
            return Carbon::parse($key)->month;
        })->mapWithKeys(function ($value, $key) {
            return [Carbon::parse($key)->isoFormat('MMMM') => $value];
        });

        return response()->json(['data' => $groupedDonations]);
    }

    public function getCampaignDonationByCampaign()
    {
        $campaignDonations = CampaignDonation::all();

        $groupedDonations = $campaignDonations->groupBy(function ($donation) {
            return $donation->campaign->title;
        })->map(function ($donations) {
            return $donations->filter(function ($donation) {
                return $donation->status === 'success';
            })->sum('amount');
        });

        return response()->json(['data' => $groupedDonations]);
    }
}
