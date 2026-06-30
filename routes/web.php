<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\FoodOrderController;
use App\Http\Controllers\ReportController;

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route setelah login
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Menu
    Route::resource('menu-items', MenuItemController::class);

    // Pesanan
    Route::resource('food-orders', FoodOrderController::class);

    // Laporan
    Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index');

});

// Redirect halaman awal
Route::redirect('/', '/dashboard');