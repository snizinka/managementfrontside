<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('isnotauthorized');

Route::post('/login', [AuthController::class, 'login'])->name('login-store')->middleware('isnotauthorized');

Route::get('/register', [AuthController::class, 'showSignup'])->name('register');

Route::post('/register', [AuthController::class, 'signup'])->name('register-store');

Route::get('/logouts', [AuthController::class, 'logout'])->name('logout');

Route::get('/restaurant/{name}', [RestaurantController::class, 'restaurant'])->name('restaurant')->middleware('isauthorized');

Route::get('/home', [Controller::class, 'home']);

Route::prefix('admin')->group(function () {
    Route::resource('dish',DishController::class);
    Route::resource('order',OrderController::class);
    Route::resource('restaurant',RestaurantController::class);
});
