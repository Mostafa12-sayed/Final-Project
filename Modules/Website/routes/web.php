<?php

use Illuminate\Support\Facades\Route;
use Modules\Website\app\Http\Controllers\CartController;
use Modules\Website\app\Http\Controllers\ProfileController;
use Modules\Website\app\Http\Controllers\WebsiteController;
use Modules\Website\app\Http\Controllers\ProductController;
use Modules\Website\app\Http\Controllers\CategoryController;
use Modules\Website\app\Http\Controllers\OrderController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {
    Route::resource('website', WebsiteController::class)->names('website');
});
Route::group(['prefix' => '/profile'], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/update_password/{id}', [ProfileController::class, 'update_password'])->name('profile.update_password');
    Route::put('/update/profile_image/{id}', [ProfileController::class, 'update_image'])->name('profile.update_image');

});


Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/quick-view/{productId}', [ProductController::class, 'getProductDetails'])->name('product.quickview');
Route::post('/products/{product}/reviews', [ProductController::class, 'storeReview'])
    ->name('products.reviews.store')
    ->middleware('auth');
// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');


Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');


Route::middleware(['auth'])->group(function () {
Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::get('/my-orders', [OrderController::class, 'index'])->name('order.list');
Route::get('/my-orders-details', [OrderController::class, 'details'])->name('order.details');
// route::get('/delete-order/{id}', [OrderController::class,'show'])->name('order.delete');
// Route::get('/my-orders/{id}', [OrderController::class, 'show'])->name('order.show');
Route::get('/track-order/{trackingNumber}', [OrderController::class, 'track'])->name('order.track');

});
