<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:donatur']], function () {
    Route::get('/dashboard', [\App\Http\Controllers\Web\Donatur\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [\App\Http\Controllers\Web\Donatur\ProfileController::class, 'index'])->name('profile');
    Route::get('/edit-profil', [\App\Http\Controllers\Web\Donatur\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/update-profile', [\App\Http\Controllers\Web\Donatur\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/riwayat-transaksi', [\App\Http\Controllers\Web\Donatur\TransactionController::class, 'index'])->name('transaction');
});
