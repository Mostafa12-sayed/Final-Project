<?php

use App\Http\Controllers\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Website\app\Http\Controllers\WebsiteController;

Route::get('/', function () {
    return view('website::index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('google/callback', [socialite::class, 'google_callback'])->name('google.callback');
Route::get('google/redirect', [Socialite::class, 'google_redirect'])->name('google.redirect');
Route::get('facebook/callback', [socialite::class, 'facebook_callback'])->name('facebook.callback');
Route::get('facebook/redirect', [socialite::class, 'facebook_redirect'])->name('facebook.redirect');
Route::get('twitter/callback', [socialite::class, 'twitter_callback'])->name('twitter.callback');
Route::get('twitter/redirect', [socialite::class, 'twitter_redirect'])->name('twitter.redirect');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
//     ->middleware(['auth', 'password.confirm']);
