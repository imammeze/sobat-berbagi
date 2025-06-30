<?php

namespace App\Interfaces;

interface CampaignLatestNewsRepositoryInterface
{
    public function getCampaignLatestNewsByCampaignId(string $campaignId);
    public function createCampaignLatestNews(array $data);
    public function getCampaignLatestNewsById(string $campaignLatestNewsId);
    public function updateCampaignLatestNews(array $data, string $campaignLatestNewsId);
    public function deleteCampaignLatestNews(string $campaignLatestNewsId);
}
