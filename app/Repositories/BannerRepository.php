<?php

namespace App\Repositories;

use App\Interfaces\BannerRepositoryInterface;
use App\Models\Banner;
use Spatie\Permission\Models\Role;

class BannerRepository implements BannerRepositoryInterface
{
    public function getAllBanners()
    {
        return Banner::all();
    }

    public function getBannerById($id)
    {
        $banner = Banner::findorfail($id);

        return $banner;
    }

    public function createBanner(array $data)
    {

        $desktopImage = $data['desktop_image']->store('banners', 'public');
        $mobileImage = $data['mobile_image']->store('banners', 'public');

        $data['desktop_image'] = $desktopImage;
        $data['mobile_image'] = $mobileImage;

        return Banner::create($data);
    }

    public function updateBanner(array $data, string $id)
    {
        $banner = Banner::find($id);

        if (isset($data['desktop_image'])) {
            $desktopImage = $data['desktop_image']->store('banners', 'public');
            $data['desktop_image'] = $desktopImage;
        }

        if (isset($data['mobile_image'])) {
            $mobileImage = $data['mobile_image']->store('banners', 'public');
            $data['mobile_image'] = $mobileImage;
        }

        return $banner->update($data);
    }

    public function deleteBanner(string $id)
    {
        $banner = Banner::find($id);
        return $banner->delete();
    }
}
