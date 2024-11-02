<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\FavouritesController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\CategoriesSubCategoriesController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\CartsController;
use App\Http\Controllers\Api\CitiesAreasController;
use App\Http\Controllers\Api\AddressesController;
use App\Http\Controllers\Api\UsersOrdersController;
use App\Http\Controllers\Api\AdvertisementController;
use App\Http\Controllers\Api\PrescriptionController;

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'home']);
    Route::get('getSearchProducts', [HomeController::class, 'getSearchProducts']);
});

Route::prefix('products')->group(function () {
    Route::get('getSearchProducts', [ProductsController::class, 'getSearchProducts']);
    Route::get('getProductsByType', [ProductsController::class, 'getProductsByType']);
    Route::get('getProductDetails', [ProductsController::class, 'getProductDetails']);
});

Route::prefix('categories')->group(function () {
    Route::get('getAll', [CategoriesSubCategoriesController::class, 'getAll']);
    Route::get('getSubCategories', [CategoriesSubCategoriesController::class, 'getSubCategories']);
});

Route::prefix('cities')->group(function () {
    Route::get('/', [CitiesAreasController::class, 'index']);
    Route::get('getCitiesHaveAreas', [CitiesAreasController::class, 'getCitiesHaveAreas']);
});

Route::prefix('settings')->group(function () {
    Route::get('/', [SettingsController::class, 'getSettings']);
    Route::get('aboutUs', [SettingsController::class, 'aboutUs']);
    Route::get('termsAndConditions', [SettingsController::class, 'termsAndConditions']);
    Route::post('sendContactUs', [SettingsController::class, 'sendContactUs']);
});


Route::prefix('users')->group(function () {
    Route::get('getSettings', [UsersController::class, 'getSettings']);
    Route::post('register', [UsersController::class, 'register']);
    Route::post('login', [UsersController::class, 'login']);
    Route::post('requestPasswordReset', [UsersController::class, 'requestPasswordReset']);
    Route::post('createTokenResetPassword', [UsersController::class, 'createTokenResetPassword']);
    Route::post('resetPassword', [UsersController::class, 'resetPassword'])->middleware('auth:users');
    Route::middleware('auth:users')->group(function () {
        Route::post('activeAccount', [UsersController::class, 'activeAccount']);
        Route::post('resendActivationCode', [UsersController::class, 'resendActivationCode']);
        Route::middleware('CheckUserVerified')->group(function () {
            Route::post('logout', [UsersController::class, 'logout']);
            Route::get('getProfile', [UsersController::class, 'getProfile']);
            Route::get('notificationsHistory', [UsersController::class, 'notificationsHistory']);
            Route::put('changeNotificationSetting', [UsersController::class, 'changeNotificationSetting']);
            Route::put('updateFirebaseToken', [UsersController::class, 'updateFirebaseToken']);
            Route::put('changeLanguage', [UsersController::class, 'changeLanguage']);
            Route::post('updateProfile', [UsersController::class, 'updateProfile']);
            Route::post('changePassword', [UsersController::class, 'changePassword']);
            Route::prefix('addresses')->group(function () {
                Route::get('getAll', [AddressesController::class, 'getAll']);
                Route::get('getDetails', [AddressesController::class, 'getDetails']);
                Route::post('add', [AddressesController::class, 'add']);
                Route::put('update', [AddressesController::class, 'update']);
                Route::put('changeDefault', [AddressesController::class, 'changeDefault']);
                Route::delete('delete', [AddressesController::class, 'delete']);
            });
            Route::prefix('favourites')->group(function () {
                Route::get('getAll', [FavouritesController::class, 'getAll']);
                Route::post('addOrRemoveProduct', [FavouritesController::class, 'addOrRemoveProduct']);
            });
            Route::prefix('carts')->group(function () {
                Route::get('getCartDetails', [CartsController::class, 'getCartDetails']);
                Route::get('getCheckoutDetails', [CartsController::class, 'getCheckoutDetails']);
                Route::get('checkCouponCode', [CartsController::class, 'checkCouponCode']);
                Route::post('addProductToCart', [CartsController::class, 'addProductToCart']);
                Route::post('checkout', [CartsController::class, 'checkout']);
                Route::put('updateProductQty', [CartsController::class, 'updateProductQty']);
                Route::delete('deleteProductFromCart', [CartsController::class, 'deleteProductFromCart']);
            });
            Route::prefix('orders')->group(function () {
                Route::get('getOrders', [UsersOrdersController::class, 'getOrders']);
                Route::get('getOrderDetails', [UsersOrdersController::class, 'getOrderDetails']);
            });
            Route::apiResource('prescriptions', PrescriptionController::class);

        });
    });
});

