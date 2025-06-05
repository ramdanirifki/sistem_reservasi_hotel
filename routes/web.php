<?php

use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TamuController;
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


Route::get('/admin/manajemen-kamar', function () {
    return view('admin.manajemen_kamar');
});

Route::get('/admin/reservasi', [ReservasiController::class, 'index']);

Route::get('/admin/pelanggan', [TamuController::class, 'index']);

// end