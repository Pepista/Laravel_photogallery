<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

// Public route to view images
Route::get('/', function () {
    $images = Image::all();  // Fetch all images
    return view('welcome', compact('images'));  // Pass images to the 'welcome' view
});

// Authentication routes (for guest users)
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

// Define the logout route
Route::post('/logout', function () {
    Auth::logout();  // Logs out the user
    return redirect()->route('login');  // Redirects the user to the login page after logout
})->name('logout');

// Admin routes for image management (requires authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');  // Display images in admin panel
    Route::post('/admin/upload', [AdminController::class, 'upload'])->name('admin.upload');  // Upload images
    Route::delete('/admin/remove/{id}', [AdminController::class, 'remove'])->name('admin.remove');  // Remove image
});

// Profile edit route (protected route for authenticated users)
Route::get('/profile-edit', function () {
    return view('profile.edit');  // Profile edit page
})->middleware('auth');

// Dashboard route (requires authentication and email verification)
Route::get('/dashboard', function () {
    return view('dashboard');  // Dashboard page
})->middleware(['auth', 'verified'])->name('dashboard');
