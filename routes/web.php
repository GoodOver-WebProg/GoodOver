<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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

Route::post('/logout',[AuthenticationController::class,'logout'])->name('route.logout');