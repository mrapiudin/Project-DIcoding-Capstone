<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard-example');
})->name('dashboard');

// Aktivitas Olahraga
Route::get('/aktivitas-olahraga', function () {
    return view('aktivitas-olahraga');
})->name('aktivitas-olahraga');

// Tracking Tidur
Route::get('/tracking-tidur', function () {
    return view('tracking-tidur');
})->name('tracking-tidur');

// Artikel Kesehatan
Route::get('/artikel-kesehatan', function () {
    return view('artikel-kesehatan');
})->name('artikel-kesehatan');

// Reminder
Route::get('/reminder', function () {
    return view('reminder');
})->name('reminder');

// Profile
Route::get('/profile', function () {
    return view('profile');
})->name('profile');
