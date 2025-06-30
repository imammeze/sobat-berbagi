<?php

namespace App\Interfaces;

interface CampaignDonationRepositoryInterface
{

    public function getAllCampaignDonations();
    public function getCampaignDonationById(string $id);
    public function createCampaignDonation(array $data);
    public function updateCampaignDonation(array $data, string $id);
    public function deleteCampaignDonation(string $id);
    public function getCampaignDonationByUserId(string $id);
    public function getCampaignDonationByMitraId(string $id);
    public function getCampaignDonationByStatus(string $status, string $isQr = null);
}
