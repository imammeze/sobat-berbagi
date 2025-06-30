<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\WhatsappNotificationController;


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('roles', \App\Http\Controllers\Web\Admin\RolesController::class);
    Route::resource('banners', \App\Http\Controllers\Web\Admin\BannerController::class);
    Route::resource('teams', \App\Http\Controllers\Web\Admin\TeamController::class);

    Route::resource('news/categories', \App\Http\Controllers\Web\Admin\NewsCategoryController::class)->names('news-categories');
    Route::resource('news-tags', \App\Http\Controllers\Web\Admin\NewsTagController::class);
    Route::resource('news', \App\Http\Controllers\Web\Admin\NewsController::class);

    Route::get('donatur', [\App\Http\Controllers\Web\Admin\DonaturController::class, 'index'])->name('donatur.index');

    Route::resource('mitra', \App\Http\Controllers\Web\Admin\MitraController::class);
    Route::post('mitra/accept', [\App\Http\Controllers\Web\Admin\MitraController::class, 'accept'])->name('mitra.accept');

    Route::get('contact', [\App\Http\Controllers\Web\Admin\ContactController::class, 'index'])->name('contact.index');
    Route::delete('contact/{id}', [\App\Http\Controllers\Web\Admin\ContactController::class, 'destroy'])->name('contact.destroy');

    Route::resource('campaign-categories', \App\Http\Controllers\Web\Admin\CampaignCategoryController::class);
    Route::resource('campaigns', \App\Http\Controllers\Web\Admin\CampaignController::class);
    Route::post('campaigns/featured/{id}', [\App\Http\Controllers\Web\Admin\CampaignController::class, 'featured'])->name('campaigns.featured');
    Route::post('campaigns/verified/{id}', [\App\Http\Controllers\Web\Admin\CampaignController::class, 'verified'])->name('campaigns.verified');

    Route::resource('campaign-latest-news', \App\Http\Controllers\Web\Admin\CampaignLatestNewsController::class);

    Route::resource('metode-pembayaran', \App\Http\Controllers\Web\Admin\PaymentMethodController::class);

    Route::resource('transaksi-campaign', \App\Http\Controllers\Web\Admin\CampaignDonationController::class);
    Route::post('transaksi-campaign/approve/{id}', [\App\Http\Controllers\Web\Admin\CampaignDonationController::class, 'approve'])->name('transaksi-campaign.approve');

    Route::resource('transaksi-zakat', \App\Http\Controllers\Web\Admin\ZakatTransactionController::class);

    Route::resource('faq-categories', \App\Http\Controllers\Web\Admin\FaqCategoryController::class);
    Route::resource('faqs', \App\Http\Controllers\Web\Admin\FaqController::class);

    // WhatsApp Notification
    Route::resource('whatsapp', WhatsappNotificationController::class);
    Route::post('whatsapp-single', [WhatsappNotificationController::class, 'storeSingle'])->name('whatsapp.store-single');
});
