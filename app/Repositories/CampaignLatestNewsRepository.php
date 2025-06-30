<?php

namespace App\Repositories;

use App\Interfaces\CampaignLatestNewsInterface;
use App\Interfaces\CampaignLatestNewsRepositoryInterface;
use App\Models\CampaignLatestNews;

class CampaignLatestNewsRepository implements CampaignLatestNewsRepositoryInterface
{

    public function getCampaignLatestNewsByCampaignId(string $campaignId)
    {
        return CampaignLatestNews::where('campaign_id', $campaignId)->get();
    }

    public function createCampaignLatestNews(array $data)
    {
        return CampaignLatestNews::create($data);
    }

    public function getCampaignLatestNewsById(string $campaignLatestNewsId)
    {
        return CampaignLatestNews::where('id', $campaignLatestNewsId)->first();
    }

    public function updateCampaignLatestNews(array $data, string $campaignLatestNewsId)
    {
        return CampaignLatestNews::where('id', $campaignLatestNewsId)->update($data);
    }


    public function deleteCampaignLatestNews(string $campaignLatestNewsId)
    {
        return CampaignLatestNews::where('id', $campaignLatestNewsId)->delete();
    }
}
