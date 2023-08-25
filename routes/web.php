<?php

use App\Http\Controllers\Web\Account\LoginController;
use App\Http\Controllers\Web\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'render']);

Route::group(['middleware' => ['guest']], function () {
    Route::post('/signin', [LoginController::class, 'signin'])->name('signin');
    Route::post('/signup', [LoginController::class, 'signup'])->name('signup');
});
