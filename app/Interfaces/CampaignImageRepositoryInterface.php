<?php

namespace App\Interfaces;

interface CampaignImageRepositoryInterface
{
    public function getAllCampaignImages();
    public function getCampaignImageById($id);
    public function createCampaignImage($data);
    public function updateCampaignImage($data, $id);
    public function deleteCampaignImage($id);
}
