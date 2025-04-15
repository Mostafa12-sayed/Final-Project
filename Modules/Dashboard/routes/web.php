<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\app\Http\Controllers\CouponController;
use Modules\Dashboard\app\Http\Controllers\DashboardController;
use Modules\Dashboard\app\Http\Controllers\AuthAdminController;
use Modules\Dashboard\app\Http\Controllers\ProductController;
use Modules\Dashboard\app\Http\Controllers\CategoryController;
use Modules\Dashboard\app\Http\Controllers\CodesController;
use Modules\Dashboard\app\Http\Controllers\ProfileController;
use Modules\Dashboard\app\Http\Controllers\SellersController;
use Modules\Dashboard\app\Http\Controllers\RoleController;
use Modules\Dashboard\app\Http\Controllers\AdminController;
use Modules\Dashboard\app\Http\Controllers\PermissionsController;
use Modules\Dashboard\app\Http\Controllers\OrdersController;

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

    //products routes
    Route::resource('/admin/products', ProductController::class)->names('admin.products');
    Route::post('/admin/products/delete-image', [ProductController::class, 'deleteImage'])->name('admin.products.delete-image');


    // sellers routes
    Route::get('/admin/sellers/orders', [SellersController::class, 'sellersOrders'])->name('admin.sellers.orders');
    Route::resource('/admin/sellers', SellersController::class)->names('admin.sellers');
    Route::get('/admin/sellers/{seller}/accept', [SellersController::class , 'accept'])->name('admin.sellers.accept');
    Route::get('/admin/sellers/{seller}/reject', [SellersController::class , 'reject'])->name('admin.sellers.reject');
    Route::post('/admin/sellers/update-status-role/{id}', [SellersController::class , 'UpdateStatusRole'])->name('admin.sellers.UpdateStatusRole');


    Route::resource('/admin/category', CategoryController::class)->names('admin.category');
    Route::resource('codes', CodesController::class)->names('admin.codes');
    Route::get('/admin/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');



    // routes of roles
    Route::Resource('/admin/roles',RoleController::class)->names('admin.roles');
    Route::Resource('/admin/admins',AdminController::class)->names('admin.admins');
    Route::post('/admin/admins/update-status', [AdminController::class, 'updateStatus']);

    Route::Resource('/admin/permissions',PermissionsController::class)->names('admin.permissions');
    Route::post('/admin/roles/update-status', [RoleController::class, 'updateStatus']);


    // routes of coupons
    Route::Resource('/admin/coupons',CouponController::class)->names('admin.coupons');
    Route::post('/admin/coupons/update-status', [CouponController::class, 'updateStatus']);


    Route::get('/admin/profile/edit', [ProfileController::class , 'index'])->name('admin.profile.edit');

    Route::post('/admin/profile/update', [ProfileController::class , 'update'])->name('admin.profile.update');
    Route::get('/admin/profile/change-password', [ProfileController::class , 'changePassword'])->name('admin.profile.changePassword');
    Route::post('/admin/profile/update-password', [ProfileController::class , 'updatePassword'])->name('admin.profile.change_password.update');

    //routes of orders
    Route::get('/admin/orders', [OrdersController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/show/{order}', [OrdersController::class, 'show'])->name('admin.order.show');
    Route::get('/admin/orders/edit/{order}', [OrdersController::class, 'edit'])->name('admin.order.edit');
    Route::post('/admin/orders/update/{order}', [OrdersController::class, 'show'])->name('admin.order.update');
    Route::get('/admin/orders/delete/{order}', [OrdersController::class, 'destroy'])->name('admin.order.delete');

    Route::get('/admin/orders/edit-order-status/{order}/{status}', [OrdersController::class, 'editStatus'])->name('admin.order.edit.change.status');



    Route::post('/admin/orders/update-status/{order}', [OrdersController::class, 'updateStatus'])->name('admin.order.update-status');
    Route::post('/admin/orders/update-payment-status/{order}', [OrdersController::class, 'updatePaymentStatus'])->name('admin.order.update-payment-status');
    Route::post('/admin/orders/update-delivery-status/{order}', [OrdersController::class, 'updateDeliveryStatus'])->name('admin.order.update-delivery-status');
    Route::post('/admin/orders/update-order-details/{order}', [OrdersController::class, 'updateOrderDetails'])->name('admin.order.update-order-details');
    Route::post('/admin/orders/update-order-address/{order}', [OrdersController::class, 'updateOrderAddress'])->name('admin.order.update-order-address');


});
