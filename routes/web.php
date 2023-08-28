<?php

use App\Http\Controllers\Web\Account\EditProfileController;
use App\Http\Controllers\Web\Account\EmailVerificationController;
use App\Http\Controllers\Web\Account\LoginController;
use App\Http\Controllers\Web\Account\ProfileController;
use App\Http\Controllers\Web\Account\SettingsController;
use App\Http\Controllers\Web\Follow\FollowsController;
use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\Posts\PostsController;
use App\Http\Controllers\Web\Search\SearchController;
use Illuminate\Support\Facades\Route;


Route::get('/', [IndexController::class, 'render'])->name('/');

Route::group(['middleware' => ['guest']], function () {
    Route::post('/signin', [LoginController::class, 'signin'])->name('signin');
    Route::post('/signup', [LoginController::class, 'signup'])->name('signup');
});

Route::group(['middleware'  => ['auth', 'verified']], function () {
    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
        Route::get('/feed', [PostsController::class, 'feed'])->name('feed');
        Route::get('/{id}/get', [PostsController::class, 'get'])->name('posts');
        Route::post('/create', [PostsController::class, 'create'])->name('create');
    });

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/{user:username}', [ProfileController::class, 'render'])->name('profile');
        Route::post('/{user:username}/follow', [FollowsController::class, 'follow']);
        Route::post('/edit', [EditProfileController::class, 'edit'])->name('edit');
    });

    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('/', [SettingsController::class, 'render'])->name('settings');
        Route::post('newinfo', [SettingsController::class, 'newInfo'])->name('newinfo');
        Route::post('newpassword', [SettingsController::class, 'newPassword'])->name('newpassword');
    });

    Route::get('/search', [SearchController::class, 'search'])->name('search');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});


Route::controller(EmailVerificationController::class)->group(function () {
    Route::get('/email/verify', 'notice')->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', 'send')->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

