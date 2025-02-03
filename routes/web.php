<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\SepedaController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('peminjam', PeminjamController::class);
Route::resource('sepeda', SepedaController::class);
Route::resource('transaksi', TransaksiController::class);
