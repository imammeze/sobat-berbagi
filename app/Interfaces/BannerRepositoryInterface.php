<?php


namespace App\Interfaces;

interface BannerRepositoryInterface
{
    public function getAllBanners();
    public function getBannerById(string $id);
    public function createBanner(array $data);
    public function updateBanner(array $data, string $id);
    public function deleteBanner(string $id);
}
