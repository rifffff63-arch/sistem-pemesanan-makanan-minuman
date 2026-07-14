<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\FoodOrderController;
use App\Http\Controllers\ReportController;


// =====================
// LOGIN & REGISTER
// =====================

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// Register

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'processRegister'])
    ->name('register.post');



// =====================
// AUTH ROUTES
// =====================

Route::middleware('auth')->group(function () {


    // =====================
    // DASHBOARD
    // =====================

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');



    // =====================
    // MENU
    // =====================

    Route::resource('menu-items', MenuItemController::class);



    // =====================
    // PESANAN
    // =====================

    Route::resource('food-orders', FoodOrderController::class);



    // =====================
    // LAPORAN
    // =====================

    Route::get('/laporan', [ReportController::class, 'index'])
        ->name('reports.index');

});



// =====================
// DEFAULT
// =====================

Route::redirect('/', '/dashboard');



// =====================
// QR MENU
// =====================

Route::get('/qr-menu', [MenuItemController::class, 'showQr'])
    ->name('qr.menu');