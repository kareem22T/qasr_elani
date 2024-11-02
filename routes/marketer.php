<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Marketer\LoginController;
use App\Http\Controllers\Marketer\DashboardController;
use App\Http\Controllers\Marketer\ProductsController;
use App\Http\Controllers\Marketer\BalanceController;
use App\Http\Controllers\Marketer\ReferralCodeController;

Route::group(['prefix' => 'marketer'], function () {
    Route::get('login', [LoginController::class, 'getShowMarketer'])->name('marketer.getLogin');
    Route::post('login', [LoginController::class, 'postMarketerLogin'])->name('marketer.postLogin');

    Route::middleware(['MarketerAuth'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('marketer.dashboard');
        Route::get('logout', [LoginController::class, 'marketerLogout'])->name('marketer.logout');

        Route::get('products-marketer/dataTable', [ProductsController::class, 'dataTable'])->name('products-marketer.dataTable');
        Route::resource('products-marketer', ProductsController::class);

        Route::resource('balances', BalanceController::class)->only('index');

        Route::resource('referral-code', ReferralCodeController::class)->only('index');
    });

});



