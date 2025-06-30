<?php

use App\Http\Controllers\Web\Admin\DashboardController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth', 'role:mitra']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('campaign', \App\Http\Controllers\Web\Admin\CampaignController::class);
    Route::get('transaksi', [\App\Http\Controllers\Web\Admin\CampaignDonationController::class, 'index'])->name('transaction.index');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Web\Admin\ProfileController::class, 'index'])->name('index');
        Route::put('/', [\App\Http\Controllers\Web\Admin\ProfileController::class, 'update'])->name('update');
        Route::put('/password', [\App\Http\Controllers\Web\Admin\ProfileController::class, 'updatePassword'])->name('update.password');
    });

    Route::get('kabar-penggunaan-dana', [\App\Http\Controllers\Web\Admin\CampaignLatestNewsController::class, 'index'])->name('campaign-latest-news.index');
    Route::get('kabar-penggunaan-dana/{slug}/create', [\App\Http\Controllers\Web\Admin\CampaignLatestNewsController::class, 'create'])->name('campaign-latest-news.create');
    Route::post('kabar-penggunaan-dana', [\App\Http\Controllers\Web\Admin\CampaignLatestNewsController::class, 'store'])->name('campaign-latest-news.store');
    Route::get('kabar-penggunaan-dana/{slug}/{id}/edit', [\App\Http\Controllers\Web\Admin\CampaignLatestNewsController::class, 'edit'])->name('campaign-latest-news.edit');
    Route::put('kabar-penggunaan-dana/{id}', [\App\Http\Controllers\Web\Admin\CampaignLatestNewsController::class, 'update'])->name('campaign-latest-news.update');
});
