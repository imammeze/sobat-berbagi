<?php

use App\Http\Controllers\Web\Auth\ForgotPasswordController;
use App\Http\Controllers\Web\Auth\RegisterMitraController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\RegisterController;
use Illuminate\Support\Facades\Route;




Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login.store');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/register-mitra', [RegisterMitraController::class, 'index'])->name('register-mitra');
Route::post('/register-mitra', [RegisterMitraController::class, 'store'])->name('register-mitra.store');

Route::get('lupa-password', [ForgotPasswordController::class, 'index'])->name('forgot-password.index');
Route::post('lupa-password', [ForgotPasswordController::class, 'store'])->name('forgot-password.store');

Route::get('/lupa-password/{token}', function (string $token) {
    return view('pages.auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('reset-password', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');

Route::group(['middleware' => ['auth']], function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
