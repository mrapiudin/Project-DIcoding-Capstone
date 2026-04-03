<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

// Aktivitas Olahraga
Route::get('/aktivitas-olahraga', function () {
    return view('activity.activity');
})->name('activity.activity');

// Tracking Tidur
Route::get('/tracking-tidur', function () {
    return view('tracking-tidur');
})->name('tracking-tidur');

// Artikel Kesehatan
Route::get('/artikel-kesehatan', function () {
    return view('artikel-kesehatan');
})->name('artikel-kesehatan');

// Profile
Route::get('/profile', function () {
    return view('profile');
})->name('profile');
