<?php

namespace App\Interfaces;

interface CampaignRepositoryInterface
{
    public function getAllCampaigns();
    public function getCampaignById($id);
    public function getCampaignBySlug($slug);
    public function createCampaign($data);
    public function updateCampaign($data, $id);
    public function deleteCampaign($id);
    public function getPaginatedCampaigns($perPage);
    public function getPaginatedCampaignsByMitra(string $mitraId);
    public function getCampaignsByStatus(string $status, int $perPage, string $category = null, string $search = null);
    public function getCampaignByMitraId(string $mitraId);
}
