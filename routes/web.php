<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\LoginCtrl;
use App\Http\Controllers\Dashboard\backEnd;
use App\Http\Controllers\Dashboard\CategoriesCtrl;
use App\Http\Controllers\Dashboard\SubCategoriesCtrl;
use App\Http\Controllers\Dashboard\UsersCtrl;
use App\Http\Controllers\Dashboard\ProductsCtrl;
use App\Http\Controllers\Dashboard\ProductsAdsController;
use App\Http\Controllers\Dashboard\CitiesCtrl;
use App\Http\Controllers\Dashboard\AreasCtrl;
use App\Http\Controllers\Dashboard\ContactsCtrl;
use App\Http\Controllers\Dashboard\OrdersCtrl;
use App\Http\Controllers\Dashboard\PushNotificationsCtrl;
use App\Http\Controllers\Dashboard\SettingsCtrl;
use App\Http\Controllers\Dashboard\CouponsCtrl;
use App\Http\Controllers\Dashboard\GroupsCtrl;
use App\Http\Controllers\Dashboard\AdminsCtrl;
use App\Http\Controllers\Dashboard\MarketerController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {

    /* START SECTION AUTH ADMINS */

    Route::get('login', [LoginCtrl::class, 'getShowAdmin']);
    Route::post('login', [LoginCtrl::class, 'postAdminLogin']);
    Route::get('logout', [LoginCtrl::class, 'adminLogout']);

    /* END SECTION AUTH ADMINS */
    Route::middleware('AdminAuth')->group(function () {
        Route::get('/', [backEnd::class, 'index']);


        /*****************  Site Settings ****************/

        Route::resource('settings', SettingsCtrl::class);


        /***************** Groups *****************/

        Route::get('groups/dataTable', [GroupsCtrl::class, 'dataTable']);
        Route::get('groups/{group}/delete', [GroupsCtrl::class, 'destroy']);
        Route::resource('groups', GroupsCtrl::class);


        /***************** Admins *****************/

        Route::get('admins/dataTable', [AdminsCtrl::class, 'dataTable']);
        Route::get('admins/{admin}/delete', [AdminsCtrl::class, 'destroy']);
        Route::resource('admins', AdminsCtrl::class);

        /***************** users *****************/

        Route::get('users/dataTable', [UsersCtrl::class, 'dataTable']);
        Route::get('users/delete', [UsersCtrl::class, 'destroy']);
        Route::get('users/{user}/activeUser', [UsersCtrl::class, 'activeUser']);
        Route::resource('users', UsersCtrl::class);

        /***************** Cities *****************/

        Route::get('cities/dataTable', [CitiesCtrl::class, 'dataTable']);
        Route::get('cities/{city}/delete', [CitiesCtrl::class, 'destroy']);
        Route::resource('cities', CitiesCtrl::class);

        /*****************   Areas *****************/

        Route::get('areas/get/{city_id}', [AreasCtrl::class, 'dataTable']);
        Route::get('areas/{area}/delete', [AreasCtrl::class, 'destroy']);
        Route::resource('areas', AreasCtrl::class);

        /***************** categories *****************/

        Route::get('categories/dataTable', [CategoriesCtrl::class, 'dataTable']);
        Route::get('categories/delete', [CategoriesCtrl::class, 'destroy'])->name('categories.delete');
        Route::get('categories/getSubCategories', [CategoriesCtrl::class, 'getSubCategories']);
        Route::resource('categories', CategoriesCtrl::class);

        /*****************  Sub Cats *****************/
        Route::get('subCategories/get/{category_id}', [SubCategoriesCtrl::class, 'dataTable']);
        Route::get('subCategories/{subCategory}/delete', [SubCategoriesCtrl::class, 'destroy']);
        Route::resource('subCategories', SubCategoriesCtrl::class);

        /***************** Products *****************/
        Route::get('products/dataTable', [ProductsCtrl::class, 'dataTable']);
        Route::get('products/{product}/delete', [ProductsCtrl::class, 'destroy']);
        Route::get('products/{product}/images/{id}/delete', [ProductsCtrl::class, 'deleteImage']);
        Route::resource('products', ProductsCtrl::class);


        /*****************  Products Ads *****************/
        Route::get('productAds/dataTable', [ProductsAdsController::class, 'dataTable']);
        Route::get('productAds/{productAd}/delete', [ProductsAdsController::class, 'destroy']);
        Route::resource('productAds', ProductsAdsController::class);

        /***************** Marketers *****************/
        Route::get('marketers/dataTable', [MarketerController::class, 'dataTable']);
        Route::get('marketers/{marketer}/delete', [MarketerController::class, 'destroy']);
        Route::get('marketers/{marketer}/resetBalance', [MarketerController::class, 'resetBalance']);
        Route::resource('marketers', MarketerController::class);


        /*****************  Contacts *****************/

        Route::get('contacts/dataTable', [ContactsCtrl::class, 'dataTable']);
        Route::get('contacts/{contact}/delete', [ContactsCtrl::class, 'destroy']);
        Route::get('contacts/{contact}/changeStatus', [ContactsCtrl::class, 'changeStatus']);
        Route::post('contacts/{contact}/addNotes', [ContactsCtrl::class, 'addNotes']);
        Route::resource('contacts', ContactsCtrl::class);

        /********************  Coupons *********************/
        Route::get('coupons/dataTable', [CouponsCtrl::class, 'dataTable']);
        Route::get('coupons/{coupon}/delete', [CouponsCtrl::class, 'destroy']);
        Route::resource('coupons', CouponsCtrl::class);


        /*****************  Manage Orders *****************/

        Route::get('orders/dataTable', [OrdersCtrl::class, 'dataTable']);
        Route::put('orders/{order}/changeStatus', [OrdersCtrl::class, 'changeStatus']);
        Route::resource('orders', OrdersCtrl::class);

        /***************** Push Notifications *****************/
        Route::get('pushNotifications/dataTable', [PushNotificationsCtrl::class, 'dataTable']);
        Route::get('pushNotifications/{pushNotification}/delete', [PushNotificationsCtrl::class, 'destroy']);
        Route::resource('pushNotifications', PushNotificationsCtrl::class);

        Route::get('lang/{lang}', function ($lang) {
            Session::put('local', $lang);
            return back();
        });
    });
});





