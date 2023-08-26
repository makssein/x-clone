<?php

use App\Http\Controllers\Web\Account\EmailVerificationController;
use App\Http\Controllers\Web\Account\LoginController;
use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\Posts\PostsController;
use Illuminate\Support\Facades\Route;


Route::get('/', [IndexController::class, 'render'])->name('/');

Route::group(['middleware' => ['guest']], function () {
    Route::post('/signin', [LoginController::class, 'signin'])->name('signin');
    Route::post('/signup', [LoginController::class, 'signup'])->name('signup');
});

Route::group(['middleware'  => ['auth', 'verified']], function () {
    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
        Route::get('/get', [PostsController::class, 'get'])->name('get');
        Route::post('/create', [PostsController::class, 'create'])->name('create');
    });
});


Route::controller(EmailVerificationController::class)->group(function () {
    Route::get('/email/verify', 'notice')->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', 'send')->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

