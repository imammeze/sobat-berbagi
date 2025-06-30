<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignDonationResource;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function getCampaignDonation($slug)
    {
        $campaign = Campaign::where('slug', $slug)->first();

        if ($campaign) {

            $donations = $campaign->donations()->where('status', 'success')->orderBy('created_at', 'desc')->paginate(10);

            return response()->json([
                'status' => 'success',
                'data' => CampaignDonationResource::collection($donations),
                'pagination' => [
                    'current_page' => $donations->currentPage(),
                    'total_pages' => $donations->lastPage(),
                    'per_page' => $donations->perPage(),
                    'total' => $donations->total(),
                ],
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Campaign not found'
        ], 404);
    }
    
    public function getAllCampaign()
    {
        $campaignDonations = Campaign::orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $campaignDonations]);
    }
}
