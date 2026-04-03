<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// User Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::get('/create-artikel', function () {
        return view('admin.create-artikel');
    })->name('admin.create-artikel');
});

// Aktivitas Olahraga
Route::get('/aktivitas-olahraga', function () {
    return view('activity.activity');
})->name('aktivitas-olahraga');

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
