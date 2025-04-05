<?php

use Illuminate\Support\Facades\Route;
use Modules\Website\app\Http\Controllers\ProfileController;
use Modules\Website\app\Http\Controllers\WebsiteController;

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
});