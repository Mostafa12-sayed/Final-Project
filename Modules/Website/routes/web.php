<?php

use Illuminate\Support\Facades\Route;
use Modules\Website\app\Http\Controllers\CartController;
use Modules\Website\app\Http\Controllers\CategoryController;
use Modules\Website\app\Http\Controllers\ComparerController;
use Modules\Website\app\Http\Controllers\OrderController;
use Modules\Website\app\Http\Controllers\ProductController;
use Modules\Website\app\Http\Controllers\ProfileController;
use Modules\Website\app\Http\Controllers\WebsiteController;
use Modules\Website\app\Http\Controllers\WishlistController;
use Srmklive\PayPal\Services\PayPal as PayPalClient;



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
Route::group(['prefix' => '/profile', 'middleware' => ['auth']], function () {
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
Route::post('/cart/add/aj/{product}', [CartController::class, 'add_ajax'])->name('cart.add_ajax');
Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
// Wishlist Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/aj/add/{product}', [WishlistController::class, 'add_ajax'])->name('wishlist.add_ajax');
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::delete('/wishlist/aj/remove/{product}', [WishlistController::class, 'remove_ajax'])->name('wishlist.remove_ajax');
});
// coupon Routes
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');
Route::get('/cart/remove-coupon', [CartController::class, 'removeCoupon'])->name('cart.removeCoupon');

Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/products/modal/{product}', [ProductController::class, 'showProduct'])->name('product.modal');
Route::get('/stores', [WebsiteController::class, 'stores'])->name('stores');
Route::get('/contact_us', [WebsiteController::class, 'contact_us'])->name('contact.index');
Route::post('/contact_us/message', [WebsiteController::class, 'contact_store'])->name('contact.store');
Route::get('/about', [WebsiteController::class, 'about_us'])->name('about.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::get('/order/complete/{id}', [OrderController::class, 'complete'])->name('order.complete');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/my-orders', [OrderController::class, 'index'])->name('order.list');
    Route::get('/my-orders/{id}', [OrderController::class, 'details'])->name('order.details');
    Route::get('/track-order', [OrderController::class, 'track'])->name('order.track');
    Route::get('/track-order/{order}', [OrderController::class, 'trackOrder'])->name('order.track.show');
});

Route::post('/compare/add/{product}', [ComparerController::class, 'add'])->name('compare.add');
Route::get('/compare', [ComparerController::class, 'index'])->name('compare.index');
Route::delete('/compare/remove/{product}', [ComparerController::class, 'remove'])->name('compare.remove');

Route::get('/paypal/success/{order}', [OrderController::class, 'paypalSuccess'])->name('paypal.success');
Route::get('/paypal/cancel/{order}', [OrderController::class, 'paypalCancel'])->name('paypal.cancel');
Route::get('/test-paypal', function () {
    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $token = $provider->getAccessToken();

    return $token ? "PayPal Connected!" : "Failed to connect";
});

Route::post('/compare/add/{product}', [ComparerController::class, 'add'])->name('compare.add');
Route::get('/compare', [ComparerController::class, 'index'])->name('compare.index');
Route::delete('/compare/remove/{product}', [ComparerController::class, 'remove'])->name('compare.remove');

Route::get('/paypal/success/{order}', [OrderController::class, 'paypalSuccess'])->name('paypal.success');
Route::get('/paypal/cancel/{order}', [OrderController::class, 'paypalCancel'])->name('paypal.cancel');
Route::get('/test-paypal', function () {
    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $token = $provider->getAccessToken();

    return $token ? "PayPal Connected!" : "Failed to connect";
});
