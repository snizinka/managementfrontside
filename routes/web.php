<?php

use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController as RC;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('isnotauthorized');

Route::post('/login', [AuthController::class, 'login'])->name('login-store')->middleware('isnotauthorized');

Route::get('/register', [AuthController::class, 'showSignup'])->name('register');

Route::post('/register', [AuthController::class, 'signup'])->name('register-store');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', [Controller::class, 'home'])->name('home');

Route::get('/restaurants', [RC::class, 'getRestaurants'])->name('restaurant');

Route::get('/restaurants/{id}', [RC::class, 'getRestaurant']);

Route::prefix('admin')->middleware(['isadmin'])->group(function () {
    Route::resource('dish',DishController::class);
    Route::resource('order',OrderController::class);
    Route::resource('restaurant',RestaurantController::class);
});
