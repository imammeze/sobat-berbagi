<?php

use App\Http\Controllers\Web\Finance\DashboardController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth', 'role:finance']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/transaksi-campaign', [\App\Http\Controllers\Web\Finance\CampaignDonationController::class, 'index'])->name('campaign-donation.index');
    Route::get('/transaksi-campaign/{id}', [\App\Http\Controllers\Web\Finance\CampaignDonationController::class, 'show'])->name('campaign-donation.show');
    Route::put('/transaksi-campaign/{id}', [\App\Http\Controllers\Web\Finance\CampaignDonationController::class, 'update'])->name('campaign-donation.update');
});
