<?php

namespace App\Interfaces;

interface CampaignCategoryRepositoryInterface
{

    public function getAllCampaignCategories();

    public function getCampaignCategoryById($id);

    public function createCampaignCategory($data);

    public function updateCampaignCategory($data, $id);

    public function deleteCampaignCategory($id);
}
