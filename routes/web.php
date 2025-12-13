<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerFoodCsellerRntroller;
use App\Http\Controllers\SellerProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/homepage', [PageController::class, 'homepage'])->name('homepage');
Route::get('/food/{id?}', [PageController::class, 'detailPage'])->name('food.detail');

Route::prefix('/register')->group(function () {
    Route::post('/', [AuthenticationController::class, 'register'])->name('register');
    Route::post('/seller', [AuthenticationController::class, 'sellerRegister'])
        ->name('register.seller')
        ->middleware(['role:user']);

    Route::prefix('/view')->group(function(){
        Route::get('/', [PageController::class, 'userRegister'])->name('register.user.view');
        Route::get('/seller', [PageController::class, 'sellerRegister'])
            ->name('register.seller.view')
            ->middleware(['role:user']);
    });
    
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
    Route::get('/', [ProductController::class, 'getProduct'])->name('route.product');
});
Route::get('/profile', [ProfileController::class, 'showProfile'])
    ->name('route.profile.view');

Route::get('/lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'id'])) {
        session(['locale' => $lang]);
        app()->setLocale($lang);
    }
    return redirect()->back();
})->name('lang.switch');
Route::prefix('/seller')->middleware(['role:seller'])->group(function () { 
    Route::get('/dashboard',[SellerProductController::class,'dashboard']);
    // Route::post('/add');
    // Route::post('/edit/{id}');
    // Route::delete('/delete/{id}');
});
