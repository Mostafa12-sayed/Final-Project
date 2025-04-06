<?php

use Illuminate\Support\Facades\Route;
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


Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
