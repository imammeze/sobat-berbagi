<?php

namespace App\Providers;

use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\BannerRepositoryInterface;
use App\Interfaces\CampaignCategoryRepositoryInterface;
use App\Interfaces\CampaignDonationRepositoryInterface;
use App\Interfaces\CampaignImageRepositoryInterface;
use App\Interfaces\CampaignLatestNewsRepositoryInterface;
use App\Interfaces\CampaignRepositoryInterface;
use App\Interfaces\ContactRepositoryInterface;
use App\Interfaces\FaqCategoryRepositoryInterface;
use App\Interfaces\FaqRepositoryInterface;
use App\Interfaces\MitraRepositoryInterface;
use App\Interfaces\NewsCategoryRepositoryInterface;
use App\Interfaces\NewsRepositoryInterface;
use App\Interfaces\NewsTagRepositoryInterface;
use App\Interfaces\PaymentMethodRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\TeamRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Repositories\BannerRepository;
use App\Repositories\CampaignCategoryRepository;
use App\Repositories\CampaignDonationRepository;
use App\Repositories\CampaignImageRepository;
use App\Repositories\CampaignLatestNewsRepository;
use App\Repositories\CampaignRepository;
use App\Repositories\ContactRepository;
use App\Repositories\FaqCategoryRepository;
use App\Repositories\FaqRepository;
use App\Repositories\MitraRepository;
use App\Repositories\NewsCategoryRepository;
use App\Repositories\NewsTagRepository;
use App\Repositories\NewsRepository;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\RoleRepository;
use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);
        $this->app->bind(NewsTagRepositoryInterface::class, NewsTagRepository::class);
        $this->app->bind(NewsCategoryRepositoryInterface::class, NewsCategoryRepository::class);
        $this->app->bind(NewsRepositoryInterface::class, NewsRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->bind(MitraRepositoryInterface::class, MitraRepository::class);
        $this->app->bind(CampaignCategoryRepositoryInterface::class, CampaignCategoryRepository::class);
        $this->app->bind(CampaignImageRepositoryInterface::class, CampaignImageRepository::class);
        $this->app->bind(CampaignRepositoryInterface::class, CampaignRepository::class);
        $this->app->bind(PaymentMethodRepositoryInterface::class, PaymentMethodRepository::class);
        $this->app->bind(CampaignDonationRepositoryInterface::class, CampaignDonationRepository::class);
        $this->app->bind(FaqCategoryRepositoryInterface::class, FaqCategoryRepository::class);
        $this->app->bind(FaqRepositoryInterface::class, FaqRepository::class);
        $this->app->bind(CampaignLatestNewsRepositoryInterface::class, CampaignLatestNewsRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
