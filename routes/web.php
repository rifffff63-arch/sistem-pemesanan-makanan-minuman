<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\FoodOrderController;

// =========================
// LOGIN
// =========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =========================
// DASHBOARD (HARUS LOGIN)
// =========================
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('menu-items', MenuItemController::class);

    Route::resource('food-orders', FoodOrderController::class);

});

// Jika membuka "/" langsung diarahkan ke dashboard
Route::redirect('/', '/dashboard');