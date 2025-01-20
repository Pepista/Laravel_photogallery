<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');


// Admin Panel Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Home Route (for authenticated users)
Route::get('/', function () {
    return view('welcome');
})->middleware('auth');  // <-- Add auth middleware to restrict access to authenticated users

// Authentication Routes
Auth::routes();

// Home Route (after login, redirect to /home)
Route::get('/home', [HomeController::class, 'index'])->name('home');
