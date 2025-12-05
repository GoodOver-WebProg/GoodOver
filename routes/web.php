<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


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
