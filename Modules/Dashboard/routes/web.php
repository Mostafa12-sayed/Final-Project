<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\app\Http\Controllers\DashboardController;
use Modules\Dashboard\app\Http\Controllers\AuthAdminController;
use Modules\Dashboard\app\Http\Controllers\ProductController;
use Modules\Dashboard\app\Http\Controllers\CategoryController;
use Modules\Dashboard\app\Http\Controllers\CodesController;
use Modules\Dashboard\app\Http\Controllers\SellersController;
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

// Route::group([], function () {
//     Route::resource('dashboard', DashboardController::class)->names('dashboard');
// });
Route::get('/reset', function () {
    return view('dashboard::product.product-add');
})->name('reset');

Route::middleware(['auth.guset.admin'])->group(function () {
Route::group(['prefix' => 'admin', 'as' => 'admin.' , ''], function () {
    Route::get('/login', [AuthAdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthAdminController::class, 'login']);
    Route::get('/register', [AuthAdminController::class, 'register'])->name('register');
    Route::post('/register', [AuthAdminController::class, 'store'])->name('register.store');
});
});


Route::middleware('auth.admin')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('/admin/products', ProductController::class)->names('admin.products');
    Route::get('/admin/sellers/orders', [SellersController::class, 'sellersOrders'])->name('admin.sellers.orders');
    Route::resource('/admin/sellers', SellersController::class)->names('admin.sellers');
    Route::get('/admin/sellers/{seller}/accept', [SellersController::class , 'accept'])->name('admin.sellers.accept');
    Route::get('/admin/sellers/{seller}/reject', [SellersController::class , 'reject'])->name('admin.sellers.reject');

    Route::resource('/admin/category', CategoryController::class)->names('admin.category');
    Route::resource('codes', CodesController::class)->names('admin.codes');
    Route::get('/admin/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');


});