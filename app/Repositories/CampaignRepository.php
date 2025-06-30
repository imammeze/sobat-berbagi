<?php

namespace App\Repositories;

use App\Interfaces\CampaignRepositoryInterface;
use App\Models\Campaign;
use App\Models\CampaignCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CampaignRepository implements CampaignRepositoryInterface
{

    public function getAllCampaigns()
    {

        if (Auth::user()->hasRole('mitra')) {
            return Campaign::where('mitra_id', Auth::user()->profile->id)->get();
        } else {
            return Campaign::orderBy('created_at', 'desc')->get();
        }
    }

    public function getCampaignBySlug($slug)
    {
        return Campaign::where('slug', $slug)->first();
    }

    public function getCampaignById($id)
    {
        return Campaign::find($id);
    }

    public function createCampaign($data)
    {
        return Campaign::create($data);
    }

    public function updateCampaign($data, $id)
    {
        return Campaign::find($id)->update($data);
    }

    public function deleteCampaign($id)
    {
        return Campaign::destroy($id);
    }

    public function getPaginatedCampaigns($perPage)
    {
        return Campaign::paginate($perPage);
    }

    public function getPaginatedCampaignsByMitra(string $mitraId)
    {
        return Campaign::where('mitra_id', $mitraId)->get();
    }


    public function getCampaignsByStatus(string $status, int $perPage, string $category = null, string $search = null, string $type = null)
    {
        $categories = CampaignCategory::all();
        
        $query = Campaign::where('status', $status);

        // Filter berdasarkan kategori jika ada
        if ($category) {
            $category = optional($categories->where('slug', $category)->first())->id;
            if ($category) {
                $query->where('campaign_category_id', $category);
            }
        }

        // Filter berdasarkan pencarian
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        // Filter berdasarkan tipe (campaign/event) jika ada
        if ($type) {
            $query->where('type', $type);
        }

        return $query->orderBy('is_featured', 'desc')
                    ->orderBy('end_date', 'desc')
                    ->paginate($perPage);
    }

    public function getCampaignByMitraId(string $mitraId)
    {
        return Campaign::where('mitra_id', $mitraId)->get();
    }
}
