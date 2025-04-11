<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Website\app\Http\Controllers\WebsiteController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;



//email verification routs//
Route::get('/', [WebsiteController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);
Route::get('/email/verify', function (Request $request) {
    return $request->user()->hasVerifiedEmail()
    ? redirect()->intended()
    : view('website::profile.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//end email verification routs//

//reset password//
Route::get('/forgot-password', function () {
    return view('website::profile.forgot_password');
})->middleware('guest')->name('password.request');


Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::ResetLinkSent
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');
//reset password//


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('google/callback', [socialite::class, 'google_callback'])->name('google.callback');
Route::get('google/redirect', [Socialite::class, 'google_redirect'])->name('google.redirect');
Route::get('facebook/callback', [socialite::class, 'facebook_callback'])->name('facebook.callback');
Route::get('facebook/redirect', [socialite::class, 'facebook_redirect'])->name('facebook.redirect');
Route::get('twitter/callback', [socialite::class, 'twitter_callback'])->name('twitter.callback');
Route::get('twitter/redirect', [socialite::class, 'twitter_redirect'])->name('twitter.redirect');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
//     ->middleware(['auth', 'password.confirm']);
