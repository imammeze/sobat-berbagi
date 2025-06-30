<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Frontend\DonaturController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api.key')->group(function () {
    Route::get('/campaigns', [\App\Http\Controllers\Api\Frontend\CampaignController::class, 'getAllCampaign'])->name('campaigns');
    Route::apiResource('donaturs', DonaturController::class);
    
    Route::get('/campaign-donations', [\App\Http\Controllers\Api\App\CampaignDonationController::class, 'getAllCampaignDonations'])->name('campaign-donations');
    Route::get('/campaign-donations-by-campaign', [\App\Http\Controllers\Api\App\CampaignDonationController::class, 'getCampaignDonationByCampaign'])->name('campaigns-donations.by-slug');
    Route::post('/check-payment', [\App\Http\Controllers\Api\Frontend\PaymentController::class, 'checkPayment'])->name('check-payment');
    Route::get('/campaigns/{slug}/donations', [\App\Http\Controllers\Api\Frontend\CampaignController::class, 'getCampaignDonation'])->name('campaigns.donations');
    Route::get('/transactions-zakat', [\App\Http\Controllers\Api\Frontend\ZakatTransactionController::class, 'getZakatMaalTransaction'])->name('transactions-zakat');

});

Route::group(['prefix' => 'finance', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/campaign-donations/pending', [\App\Http\Controllers\Api\Finance\CampaignDonationController::class, 'getAllCampaignDonationsPending'])->name('campaign-donations.pending');
});

