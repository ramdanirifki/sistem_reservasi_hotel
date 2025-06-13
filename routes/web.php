<?php

use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\KamarController;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing_page');
});

Route::get('/login', function () {
    return view('login_page');
});
 
Route::get('/register', function () {
    return view('register_page');
});

Route::get('/reservasi', function () {
    return view('reservasi_page');
});


// bagian route admin
Route::get('/admin', function () {
    return view('admin.login_admin_page');
});

Route::get('/admin/login', function () {
    return view('admin.login_admin_page');
});
Route::post('/admin/proses_login', [AutentikasiController::class, 'login_admin']);
Route::post('/admin/logout', [AutentikasiController::class, 'logout']);

Route::get('/admin/dashboard', [DashboardController::class, 'index']);

Route::get('/admin/manajemen-kamar', [KamarController::class, 'index'])->name('manajemen-kamar');
Route::post('/admin/kamar', [KamarController::class, 'store'])->name('kamar.store');
Route::delete('/admin/kamar/{kamar}', [KamarController::class, 'destroy'])->name('kamar.destroy');

Route::get('/admin/reservasi', [ReservasiController::class, 'index']);
Route::post('/admin/reservasi/tambah', [ReservasiController::class, 'store'])->name('reservasi.store');
Route::delete('/admin/reservasi/hapus/{id}', [ReservasiController::class, 'destroy'])->name('reservasi.destroy');

Route::get('/admin/tamu', [TamuController::class, 'index'])->name('tamu.index');
Route::post('/admin/tamu', [TamuController::class, 'store'])->name('tamu.store');
Route::get('/admin/tamu/{tamu}/edit', [TamuController::class, 'edit'])->name('tamu.edit');
Route::put('/admin/tamu/{tamu}', [TamuController::class, 'update'])->name('tamu.update');
Route::delete('/admin/tamu/{id}', [TamuController::class, 'destroy'])->name('tamu.destroy');

Route::get('/admin/pembayaran', function () {
    return view('admin.pembayaran');
});

// end