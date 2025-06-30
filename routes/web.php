<?php

use App\Http\Controllers\Web\Auth\RegisterMitraController;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Auth\ForgotPasswordController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\Frontend\MidtransController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Pusher\Pusher;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\Web\Frontend\LandingController::class, 'index'])->name('home');
Route::get('/zakat-maal', [\App\Http\Controllers\Web\Frontend\ZakatController::class, 'maal'])->name('zakat-maal');
Route::get('/zakat-fitrah', [\App\Http\Controllers\Web\Frontend\ZakatController::class, 'fitrah'])->name('zakat-fitrah');
Route::get('/mitra-kami', [\App\Http\Controllers\Web\Frontend\MitraController::class, 'index'])->name('mitra.index');
Route::get('/mitra-kami/{slug}', [\App\Http\Controllers\Web\Frontend\MitraController::class, 'show'])->name('mitra.show');
Route::get('/visi-misi', [\App\Http\Controllers\Web\Frontend\VisionMissionController::class, 'index'])->name('vision-mission');
Route::get('/kontak-kami', [\App\Http\Controllers\Web\Frontend\ContactController::class, 'index'])->name('contact');
Route::post('/kontak-kami', [\App\Http\Controllers\Web\Frontend\ContactController::class, 'store'])->name('contact.store');
Route::get('/tim-kami', [\App\Http\Controllers\Web\Frontend\TeamConttroller::class, 'index'])->name('team');
Route::get('/faq', [\App\Http\Controllers\Web\Frontend\FaqController::class, 'index'])->name('faq');
Route::get('/profil-kami', [\App\Http\Controllers\Web\Frontend\AboutController::class, 'index'])->name('about-us');

Route::group(['prefix' => 'berita', 'as' => 'news.'], function () {
    Route::get('/', [\App\Http\Controllers\Web\Frontend\NewsController::class, 'index'])->name('index');
    Route::get('/{slug}', [\App\Http\Controllers\Web\Frontend\NewsController::class, 'show'])->name('show');
});

Route::group(['prefix' => 'campaign', 'as' => 'campaign.'], function () {
    Route::get('/', [\App\Http\Controllers\Web\Frontend\CampaignController::class, 'index'])->name('index');
    Route::get('/{campaign:slug}', [\App\Http\Controllers\Web\Frontend\CampaignController::class, 'show'])->name('show');
});

Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
    Route::get('/', [\App\Http\Controllers\Web\Frontend\EventController::class, 'index'])->name('index');
    Route::get('/{campaign:slug}', [\App\Http\Controllers\Web\Frontend\EventController::class, 'show'])->name('show');
});


Route::group(['prefix' => 'kalkulator-zakat', 'as' => 'zakat-calculator.'], function () {
    Route::get('/', [\App\Http\Controllers\Web\Frontend\ZakatCalculatorController::class, 'index'])->name('index');
    Route::get('/tabungan', [\App\Http\Controllers\Web\Frontend\ZakatCalculatorController::class, 'calculateSaving'])->name('saving');
    Route::get('/emas', [\App\Http\Controllers\Web\Frontend\ZakatCalculatorController::class, 'calculateGold'])->name('gold');
    Route::get('/perdagangan', [\App\Http\Controllers\Web\Frontend\ZakatCalculatorController::class, 'calculateTrading'])->name('trading');
    Route::get('/perusahaan', [\App\Http\Controllers\Web\Frontend\ZakatCalculatorController::class, 'calculateCompany'])->name('company');
    Route::get('/pertanian', [\App\Http\Controllers\Web\Frontend\ZakatCalculatorController::class, 'calculateFarming'])->name('farming');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('donasi/{campaign:slug}', [\App\Http\Controllers\Web\Frontend\DonationController::class, 'create'])->name('donation.create');

    // Route::post('/midtrans/notification', [MidtransController::class, 'handleNotification']);
    // Route::get('/midtrans/transaction/{campaign}', [MidtransController::class, 'createTransaction']);

    Route::post('/midtrans/transaction', [MidtransController::class, 'createTransaction']);
    Route::get('/midtrans/transaction/{orderId}/status', [MidtransController::class, 'checkTransactionStatus']);
    Route::get('/midtrans/webhook', [MidtransController::class, 'handleNotification'])->name('midtrans.webhook');
    
    Route::get('donasi/pembayaran/{campaign:slug}/{donation}/{paymentMethod}', [\App\Http\Controllers\Web\Frontend\DonationController::class, 'payment'])->name('donation.payment');
    Route::post('donasi/process/{campaign:slug}/{donation}', [\App\Http\Controllers\Web\Frontend\DonationController::class, 'processPayment'])->name('donation.payment.store');
    Route::get('donasi/pembayaran-qris/{campaign:slug}/{donation}', [\App\Http\Controllers\Web\Frontend\DonationController::class, 'paymentQris'])->name('donation.payment.qris');
    Route::get('donasi/process/success/{campaign:slug}/{donation}', [\App\Http\Controllers\Web\Frontend\DonationController::class, 'success'])->name('donation.success');
    Route::get('donasi/success/{campaign:slug}/{donation}', [\App\Http\Controllers\Web\Frontend\DonationController::class, 'successView'])->name('donation.successView');

    Route::get('zakat-maal/pembayaran/{paymentMethod}/{zakat}', [\App\Http\Controllers\Web\Frontend\ZakatTransactionController::class, 'payment'])->name('zakat-maal.payment');
    Route::post('zakat-maal/process/{zakat}', [\App\Http\Controllers\Web\Frontend\ZakatTransactionController::class, 'processPayment'])->name('zakat-maal.payment.store');
    Route::get('zakat-maal/process/success/{zakat}', [\App\Http\Controllers\Web\Frontend\ZakatTransactionController::class, 'successView'])->name('zakat-maal.success');
    Route::post('zakat-maal/process', [\App\Http\Controllers\Web\Frontend\ZakatTransactionController::class, 'store'])->name('zakat-maal.store');

    Route::get('zakat-fitrah/pembayaran/{paymentMethod}/{zakat}', [\App\Http\Controllers\Web\Frontend\ZakatTransactionController::class, 'payment'])->name('zakat-fitrah.payment');
    Route::post('zakat-fitrah/process/{zakat}', [\App\Http\Controllers\Web\Frontend\ZakatTransactionController::class, 'processPayment'])->name('zakat-fitrah.payment.store');
    Route::get('zakat-fitrah/process/success/{zakat}', [\App\Http\Controllers\Web\Frontend\ZakatTransactionController::class, 'successView'])->name('zakat-fitrah.success');
    Route::post('zakat-fitrah/process', [\App\Http\Controllers\Web\Frontend\ZakatTransactionController::class, 'store'])->name('zakat-fitrah.store');
});

Route::post('donasi/{campaign:slug}', [\App\Http\Controllers\Web\Frontend\DonationController::class, 'store'])->name('donation.store');


Route::get('donasi/{campaign:slug}/metode-pembayaran', [\App\Http\Controllers\Web\Frontend\DonationController::class, 'paymentMethod'])->name('donation.paymentMethod');
Route::get('donasi/{campaign:slug}/konfirmasi', [\App\Http\Controllers\Web\Frontend\DonationController::class, 'confirmation'])->name('donation.confirmation');


Route::get('zakat-maal/metode-pembayaran', [\App\Http\Controllers\Web\Frontend\ZakatTransactionController::class, 'paymentMethod'])->name('zakat-maal.paymentMethod');
Route::get('zakat-maal/konfirmasi', [\App\Http\Controllers\Web\Frontend\ZakatTransactionController::class, 'confirmation'])->name('zakat-maal.confirmation');

Route::get('zakat-fitrah/metode-pembayaran', [\App\Http\Controllers\Web\Frontend\ZakatTransactionController::class, 'paymentMethod'])->name('zakat-fitrah.paymentMethod');
Route::get('zakat-fitrah/konfirmasi', [\App\Http\Controllers\Web\Frontend\ZakatTransactionController::class, 'confirmation'])->name('zakat-fitrah.confirmation');


Route::get('kurban/{slug}/metode-pembayaran', [\App\Http\Controllers\Web\Frontend\SacrificialController::class, 'paymentMethod'])->name('kurban.paymentMethod');
Route::get('kurban/{slug}/konfirmasi', [\App\Http\Controllers\Web\Frontend\SacrificialController::class, 'confirmation'])->name('kurban.confirmation');
