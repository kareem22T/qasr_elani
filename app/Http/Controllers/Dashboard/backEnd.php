<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Group;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAd;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class backEnd extends Controller
{


    public function index()
    {
        $countGroups            = Group::count();
        $countAdmins            = Admin::count();
        $pendingUsers           = User::where('activation_code','!=',1)->count();
        $activeUsers            = User::whereActivationCode(1)->count();
        $countCities            = City::count();
        $countAreas             = Area::count();
        $inactiveCategories     = Category::whereIsActive(0)->count();
        $activeCategories       = Category::whereIsActive(1)->count();
        $inactiveSubCategories  = SubCategory::whereIsActive(0)->count();
        $activeSubCategories    = SubCategory::whereIsActive(1)->count();
        $inactiveProducts       = Product::whereIsActive(0)->count();
        $activeProducts         = Product::whereIsActive(1)->count();
        $inactiveProductsAds    = ProductAd::whereIsActive(0)->count();
        $activeProductsAds      = ProductAd::whereIsActive(1)->count();
        $openContacts           = Contact::whereStatus(0)->count();
        $closedContacts         = Contact::whereStatus(1)->count();
        $inactiveCoupons        = Coupon::whereIsActive(0)->count();
        $activeCoupons          = Coupon::whereIsActive(1)->count();
        $countOrders            = Order::count();

        return view('admin.index', compact('countGroups', 'countAdmins', 'pendingUsers', 'activeUsers', 'countCities', 'countAreas', 'inactiveCategories', 'activeCategories', 'inactiveSubCategories','activeSubCategories','inactiveProducts','activeProducts','inactiveProductsAds','activeProductsAds','openContacts','closedContacts', 'inactiveCoupons', 'activeCoupons', 'countOrders'));
    }
}

