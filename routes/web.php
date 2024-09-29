<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', [ProductController::class, 'index'])->name('index');
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::get('/shop-detail', [ProductController::class, 'shopdetails'])->name('shop-detail');
Route::get('/contact', function () {return view('contact');})->name('contact');
Route::get('/testimonial', function () {return view('testimonial');})->name('testimonial');
Route::get('/chackout', function () {return view('chackout');})->name('chackout');
Route::get('/cart', function () {return view('cart');})->name('cart');

Route::resource('/add_product', ProductController::class)->names([
    'index' => 'product.index',
    'create' => 'product.create',
    'edit' => 'product.edit',
    'update' => 'product.update',
]);

Route::post('/add_product', [ProductController::class, 'store'])->name('product.store');
Route::any('/store-comment', [ProductController::class, 'addComment'])->name('comment.store');

Route::get('/dashboard', function () {return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
