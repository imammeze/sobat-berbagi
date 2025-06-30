<?php

namespace App\Repositories;

use App\Interfaces\CampaignImageRepositoryInterface;
use App\Models\CampaignImage;

class CampaignImageRepository implements CampaignImageRepositoryInterface
{
    public function getAllCampaignImages()
    {
        return CampaignImage::all();
    }

    public function getCampaignImageById($id)
    {
        return CampaignImage::findOrFail($id);
    }

    public function createCampaignImage($data)
    {
        return CampaignImage::create($data);
    }

    public function updateCampaignImage($data, $id)
    {
        return CampaignImage::findOrFail($id)->update($data);
    }

    public function deleteCampaignImage($id)
    {
        return CampaignImage::findOrFail($id)->delete();
    }
}
