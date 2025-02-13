<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\SepedaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('peminjam', PeminjamController::class);
    Route::resource('sepeda', SepedaController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::get('transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/profile', [LoginController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [LoginController::class, 'updateProfile']);
    Route::get('/profile/edit', [LoginController::class, 'showEditProfile'])->name('profile.edit');
    Route::get('sepeda', [SepedaController::class, 'index'])->name('sepeda.index');
});