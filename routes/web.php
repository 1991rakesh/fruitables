<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


 Route::get('/', function () {return view('index');})->name('index');
// Route::get('/index', function () {return view('index');})->name('index');
Route::get('/shop', function () {return view('shop');})->name('shop');
Route::get('/shop-detail', function () {return view('shop-detail');})->name('shop-detail');
Route::get('/testimonial', function () {return view('testimonial');})->name('testimonial');
Route::get('/contact', function () {return view('contact');})->name('contact');
Route::get('/chackout', function () {return view('chackout');})->name('chackout');
Route::get('/cart', function () {return view('cart');})->name('cart');

Route::resource('/add_product', ProductController::class)->names([
    'index' => 'product.index',
    'create' => 'product.create',
    'store' => 'product.store',
    'edit' => 'product.edit',
    'update' => 'product.update'
]);

Route::get('/comments', function () {return view('products.comments');})->name('comments');
Route::get('/add-comment', [ProductController::class, 'showCommentForm']);
Route::post('/store-comment', [ProductController::class, 'addComment'])->name('comment.store');



// Route::get('/add_products', function () {
//     return view('products.add_products');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
