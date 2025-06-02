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