<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', [ProductController::class, 'index'])->name('index');
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::get('/shop-detail', [ProductController::class, 'shopdetails'])->name('shop-detail');
Route::get('/contact', function () {return view('contact');})->name('contact');
Route::get('/testimonial', function () {return view('testimonial');})->name('testimonial');
Route::get('/chackout', [ProductController::class, 'showchackoutPage'])->name('chackout');
Route::get('/cart', [ProductController::class, 'showCartPage'])->name('cart');

Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('product-edit');
Route::patch('/products/{id}', [ProductController::class, 'update'])->name('product-update');

Route::get('/add_to_cart', [ProductController::class, 'addToCart'])->name('add_to_cart');


Route::resource('/add_product', ProductController::class)->names([
    'index' => 'product.index',
    'create' => 'product.create',
    // 'edit' => 'product.edit',
    'update' => 'product.update',
]);

Route::post('/add_product', [ProductController::class, 'store'])->name('product.store');
Route::any('/store-comment', [ProductController::class, 'addComment'])->name('comment.store');

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/place-order', [ProductController::class, 'placedOrder'])->name('place.order');

});

require __DIR__.'/auth.php';
