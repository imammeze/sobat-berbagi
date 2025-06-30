<?php

namespace App\Repositories;

use App\Interfaces\CampaignCategoryRepositoryInterface;
use App\Models\CampaignCategory;

class CampaignCategoryRepository implements CampaignCategoryRepositoryInterface
{

    public function getAllCampaignCategories()
    {
        return CampaignCategory::all();
    }

    public function getCampaignCategoryById($id)
    {
        return CampaignCategory::find($id);
    }

    public function createCampaignCategory($data)
    {
        return CampaignCategory::create($data);
    }

    public function updateCampaignCategory($data, $id)
    {
        return CampaignCategory::find($id)->update($data);
    }

    public function deleteCampaignCategory($id)
    {
        return CampaignCategory::destroy($id);
    }
}
