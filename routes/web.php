<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerAccountManagementController;
use App\Http\Controllers\BuyerAccountManagementController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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

        //Homepage
        Route::get('/homepage', [SellerController::class, 'index'])
            ->name('index');

        //Product
        Route::resource('/product', ProductController::class);
});

//Buyer
Route::middleware(['auth', 'role:buyer'])
    ->prefix('buyer')
    ->name('buyer.')
    ->group(function(){

        //Homepage
        Route::get('/homepage', [BuyerController::class, 'index'])
            ->name('index');

        //Show specific product
        Route::get('/products/{product}', [BuyerController::class, 'show'])
            ->name('product.show');

        // // Ke shop seller
        Route::get('/seller/{seller}', [ShopController::class, 'show'])
            ->name('seller.shop');

        // Cart untuk buyer
        Route::resource('/cart', CartController::class);

        //checkout
        Route::post('/checkout', [CheckoutController::class, 'store'])
            ->name('checkout.store');

        //Membuat order
        Route::get('/orders', [BuyerController::class, 'orders'])
            ->name('orders.index');

        //Detail order
        route::get('/orders/{order}', [BuyerController::class, 'showOrder'])
            ->name('orders.show');

        
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
