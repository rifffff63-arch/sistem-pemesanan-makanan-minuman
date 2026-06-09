<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\FoodOrderController;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('menu-items', MenuItemController::class);
Route::resource('food-orders', FoodOrderController::class);