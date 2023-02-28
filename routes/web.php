<?php

use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController as RC;
use App\Http\Controllers\DishController as DC;
use App\Http\Controllers\CartController as CC;
use App\Http\Controllers\OrderController as OC;
use App\Http\Controllers\Admin\DriverController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['iscustomer'])->group(function () {
    Route::get('/restaurants', [RC::class, 'getRestaurants'])->name('restaurant');

    Route::get('/restaurants/{id}', [RC::class, 'getRestaurant'])->name('restaurants');

    Route::get('/dishes/{id}', [DC::class, 'showDish'])->name('dishes');

    Route::post('/cart/{id}', [CC::class, 'addToCart'])->name('dishesAdd');

    Route::get('/cart', [CC::class, 'showCart'])->name('cart');

    Route::get('/cart/remove/{id}', [CC::class, 'removeItem'])->name('cartRemove');

    Route::get('/order', [OC::class, 'orderForm'])->name('order');

    Route::post('/order', [OC::class, 'order'])->name('orderMake');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('isnotauthorized');

Route::post('/login', [AuthController::class, 'login'])->name('login-store')->middleware('isnotauthorized');

Route::get('/register', [AuthController::class, 'showSignup'])->name('register');

Route::post('/register', [AuthController::class, 'signup'])->name('register-store');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', [Controller::class, 'home'])->name('home');

Route::prefix('admin')->middleware(['isadmin'])->group(function () {
    Route::resource('dish',DishController::class);
    Route::resource('order',OrderController::class);
    Route::resource('restaurant',RestaurantController::class);
    Route::get('/drivers', [DriverController::class, 'getDrivers'])->name('getDrivers');
    Route::get('/drivers/add', [DriverController::class, 'addDriver'])->name('addDriver');
    Route::post('/drivers/add', [DriverController::class, 'insertDriver'])->name('insertDriver');
    Route::get('/drivers/update/{id}', [DriverController::class, 'updateFormDriver'])->name('updateFormDriver');
    Route::get('/drivers/{id}', [DriverController::class, 'showDriver'])->name('showDriver');
    Route::put('/drivers/{id}', [DriverController::class, 'updateDriver'])->name('updateDriver');
    Route::delete('/drivers/{id}', [DriverController::class, 'removeDriver'])->name('removeDriver');
});
