<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\app\Http\Controllers\AdminController;
use Modules\Dashboard\app\Http\Controllers\AuthAdminController;
use Modules\Dashboard\app\Http\Controllers\CategoryController;
use Modules\Dashboard\app\Http\Controllers\CodesController;
use Modules\Dashboard\app\Http\Controllers\CouponController;
use Modules\Dashboard\app\Http\Controllers\CustomerController;
use Modules\Dashboard\app\Http\Controllers\DashboardController;
use Modules\Dashboard\app\Http\Controllers\OrdersController;
use Modules\Dashboard\app\Http\Controllers\PermissionsController;
use Modules\Dashboard\app\Http\Controllers\ProductController;
use Modules\Dashboard\app\Http\Controllers\ProfileController;
use Modules\Dashboard\app\Http\Controllers\RoleController;
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
//Route::get(
// function () {
//    return view('dashboard::product.product-add');
//})->name('reset');
Route::middleware('checkUserNormal')->group(function (){
    Route::middleware(['auth.guset.admin'])->group(function () {
        Route::group(['prefix' => 'admin', 'as' => 'admin.', ''], function () {
            Route::get('/login', [AuthAdminController::class, 'showLoginForm'])->name('login');
            Route::post('/login', [AuthAdminController::class, 'login']);
            Route::get('/register', [AuthAdminController::class, 'register'])->name('register');
            Route::post('/register', [AuthAdminController::class, 'store'])->name('register.store');
            Route::get('/reset-password', [AuthAdminController::class, 'passwordReset'])->name('reset-password');
            Route::post('/reset-password/store', [AuthAdminController::class, 'passwordResetLink'])->name('reset-password.store');
            Route::get('/change-password', [AuthAdminController::class, 'passwordChange'])->name('change-password');
            Route::post('/change-password/store', [AuthAdminController::class, 'passwordChangeStore'])->name('change-password.store');
        });
    });
    Route::middleware('auth.admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // products routes
        Route::resource('/admin/products', ProductController::class)->names('admin.products');
        Route::post('/admin/products/delete-image', [ProductController::class, 'deleteImage'])->name('admin.products.delete-image');

        // sellers routes
        Route::post('/admin/sellers/update-status-role/{id}', [SellersController::class, 'UpdateStatusRole'])->name('admin.sellers.UpdateStatusRole');
        Route::get('/admin/sellers/orders', [SellersController::class, 'sellersOrders'])->name('admin.sellers.orders');
        Route::resource('/admin/sellers', SellersController::class)->names('admin.sellers');
        Route::get('/admin/sellers/{seller}/accept', [SellersController::class, 'accept'])->name('admin.sellers.accept');
        Route::get('/admin/sellers/{seller}/reject', [SellersController::class, 'reject'])->name('admin.sellers.reject');

        Route::resource('/admin/category', CategoryController::class)->names('admin.category');
        Route::resource('codes', CodesController::class)->names('admin.codes');
        Route::get('/admin/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');

        // routes of roles
        Route::Resource('/admin/roles', RoleController::class)->names('admin.roles');
        Route::Resource('/admin/admins', AdminController::class)->names('admin.admins');
        Route::post('/admin/admins/update-status', [AdminController::class, 'updateStatus']);

        Route::Resource('/admin/permissions', PermissionsController::class)->names('admin.permissions');
        Route::post('/admin/roles/update-status', [RoleController::class, 'updateStatus']);

        // routes of coupons
        Route::Resource('/admin/coupons', CouponController::class)->names('admin.coupons');
        Route::post('/admin/coupons/update-status', [CouponController::class, 'updateStatus']);

        Route::get('/admin/profile/edit', [ProfileController::class, 'index'])->name('admin.profile.edit');

        Route::post('/admin/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');
        Route::get('/admin/profile/change-password', [ProfileController::class, 'changePassword'])->name('admin.profile.changePassword');
        Route::post('/admin/profile/update-password', [ProfileController::class, 'updatePassword'])->name('admin.profile.change_password.update');

        // routes of orders
        Route::get('/admin/orders', [OrdersController::class, 'index'])->name('admin.orders.index');
        Route::get('/admin/orders/show/{order}', [OrdersController::class, 'show'])->name('admin.order.show');
        Route::get('/admin/orders/edit/{order}', [OrdersController::class, 'edit'])->name('admin.order.edit');
        Route::post('/admin/orders/update/{order}', [OrdersController::class, 'show'])->name('admin.order.update');
        Route::get('/admin/orders/delete/{order}', [OrdersController::class, 'destroy'])->name('admin.order.delete');

        Route::post('/admin/orders/change-status', [OrdersController::class, 'editStatus'])->name('admin.order.edit.change.status');

        Route::get('/admin/orders/change-status-admin/{order}/{status}', [OrdersController::class, 'editStatusAdmin'])->name('admin.order.change.status.admin');
        Route::get('/admin/orders/change-status-seller/{order}/{status}', [OrdersController::class, 'editStatusSeller'])->name('admin.order.change.status.seller');

        Route::post('/admin/orders/update-shipping-vale/{order}', [OrdersController::class, 'updateChangeShippingValue'])->name('admin.order.update-update-shipping-value');

        Route::post('/admin/orders/update-payment-status/{order}', [OrdersController::class, 'updatePaymentStatus'])->name('admin.order.update-payment-status');
        Route::get('/admin/orders/invoice/{order}', [OrdersController::class, 'invoice'])->name('admin.order.invoice');
        //    Route::get('/admin/orders/confirm/{order}', [OrdersController::class, 'invoice'])->name('admin.order.invoice');


        // routes of contact us
        Route::get('/admin/contact-us', [DashboardController::class, 'contactUs'])->name('admin.contact-us.index');
        Route::get('/admin/contact-us/{id}/delete', [DashboardController::class, 'contactUsDelete'])->name('admin.contact-us.delete');
        Route::get('/admin/contact-us/{id}/show', [DashboardController::class, 'contactUsShow'])->name('admin.contact-us.show');
        Route::get('/admin/contact-us/newSend', [DashboardController::class, 'SendMail'])->name('admin.contact-us.send.mail');
        Route::post('/admin/contact-us/save', [DashboardController::class, 'SaveMail'])->name('admin.contact-us.store');

        Route::get('/admin/contact-us/{id}/send', [DashboardController::class, 'contactUsReplaySend'])->name('admin.contact-us.replay.send');
        Route::post('/admin/contact-us/replay/{id}', [DashboardController::class, 'contactUsReplayStore'])->name('admin.contact-us.replay.store');

        Route::resource('/admin/customers', CustomerController::class)->names('admin.customers');

    });
});
