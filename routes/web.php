<?php

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

Route::get('/admin/dashboard', function () {
    return view('admin.admin_page');
});

Route::get('/admin/manajemen-kamar', function () {
    return view('admin.manajemen_kamar');
});

Route::get('/admin/reservasi', function () {
    return view('admin.reservasi');
});

Route::get('/admin/pelanggan', function () {
    return view('admin.pelanggan');
});