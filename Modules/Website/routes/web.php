<?php

use Illuminate\Support\Facades\Route;
use Modules\Website\app\Http\Controllers\CartController;
use Modules\Website\app\Http\Controllers\ProfileController;
use Modules\Website\app\Http\Controllers\WebsiteController;
use Modules\Website\app\Http\Controllers\ProductController;
use Modules\Website\app\Http\Controllers\CategoryController;

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

// Cart Routes
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
