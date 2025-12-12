<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerProfileController;

Route::get('/', [PageController::class, 'homepage'])->name('homepage');
Route::get('/food/{id?}', [PageController::class, 'detailPage'])->name('food.detail');

Route::prefix('/register')->group(function () {
    Route::post('/', [AuthenticationController::class, 'register'])->name('route.register');

    Route::get('/view', function () {
        return view('pages.register');
    })->name('route.register.view');
});

Route::prefix('/login')->group(function () {

    Route::post('/', [AuthenticationController::class, 'login'])->name('route.login');

    Route::get('/view', function () {
        return view('pages.login');
    })->name('route.login.view');
});

Route::post('/logout', [AuthenticationController::class, 'logout'])->name('route.logout');

Route::get('/list', [PageController::class, 'listPage'])->name('route.list');

Route::prefix('/product')->group(function () {
    // Route::get('/', [ProductController::class, 'getAll'])->name('route.product.all');
    Route::get('/', [ProductController::class, 'getProduct'])->name('route.product');
});
Route::get('/profile', [ProfileController::class, 'showProfile'])
     ->name('route.profile.view');

Route::get('/seller/profile', [SellerProfileController::class, 'edit'])
    ->name('seller.profile.edit');

Route::post('/seller/profile/update', [SellerProfileController::class, 'update'])
    ->name('seller.profile.update');
