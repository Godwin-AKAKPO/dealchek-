<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\MessageController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('welcome');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Products
    Route::resource('products', ProductController::class);
    
    // Seller
    Route::get('/seller/register', [SellerController::class, 'register'])->name('seller.register');
    Route::post('/seller/register', [SellerController::class, 'store'])->name('seller.store');
    Route::get('/seller/products', [SellerController::class, 'products'])->name('seller.products');
    Route::get('/seller/sales', [SellerController::class, 'sales'])->name('seller.sales');
    
    // Purchases
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    
    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
});

require __DIR__.'/auth.php';