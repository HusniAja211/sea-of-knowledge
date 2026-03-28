<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerAccountManagementController;
use App\Http\Controllers\BuyerAccountManagementController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Admin routes
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function(){

        //Dashboard
        Route::get('/index', [AdminController::class, 'index'])
            ->name('index');

        // Seller Account
        Route::resource('/seller', SellerAccountManagementController::class)->parameters(['seller' => 'user']);

        // Buyer Account
        Route::resource('/buyer', BuyerAccountManagementController::class)->parameters(['buyer' => 'user']);

        //Category
        Route::resource('/category', CategoryController::class);

});

// Seller
Route::middleware(['auth', 'role:seller'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function(){

        //Dashboard
        Route::get('/homepage', [SellerController::class, 'index'])
            ->name('index');

        //Product
        Route::resource('/product', ProductController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
