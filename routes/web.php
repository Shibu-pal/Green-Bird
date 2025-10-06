<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Auth;

Route::controller(HomeController::class)->group(function () {
    Route::get('/','index')->name('home');
    Route::get('/logout','logout')->name('logout')->middleware('auth');
    Route::middleware(['guest'])->group(function () {
        Route::view('/sign-in','login')->name('login');
        Route::view('/sign-up','login')->name('register');
        Route::post('/sign-in','login')->name('in');
        Route::post('/sign-up','register')->name('up');
        Route::get('/otp-validate', 'showOtp')->name('OTP');
        Route::post('/otp-validate','otp')->name('otp_validate');
        Route::view('/forget','forget')->name('forget');
        Route::post('/forget','forget_otp')->name('forget_otp');
        Route::get('/forget-otp-validate', 'showForgetOtp')->name('show_OTP');
        Route::view('/new-password','new_password')->name('new_password');
        Route::post('/forget-otp-validate','to_pass')->name('forget_otp_validate');
        Route::post('/set-password', 'set_password')->name('set_password');
        Route::get('/auth/redirection/{provider}', 'redirect')->name('auth.redirect');
        Route::get('/auth/{provider}/callback', 'callback')->name('auth.callback');
    });
    
});

Route::controller(ItemController::class)->group(function(){
    Route::get('/category/{id}','category')->name('category');
    Route::get('/sell/{id}','product')->name('product');
    Route::middleware('auth')->group(function(){
        Route::view('/sell','listing')->name('sell');
        Route::post('/sell','listing')->name('selling');
        Route::get('/cart','cart_list')->name('cart_list');
        Route::get('/cart/{id}','add_cart')->name('add_cart');
        Route::get('/cart/remove/{id}','remove_cart')->name('remove_cart');
        Route::get('/notification','notification')->name('notification');
        Route::post('/notification','send_notification')->name('send_notification');
        Route::get('/notification/{id}','set_notification')->name('set_notification');
        Route::get('/notification/delete/{id}','delete_notification')->name('delete_notification');
        Route::post('/send-time','send_time')->name('send_time');
        Route::get('/notification/cancel/{id}','cancel_notification')->name('cancel_notification');
    });
});
