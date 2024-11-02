<?php

namespace App\Http\Controllers\Marketer;

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
use App\Models\UserPrescription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $marketer = auth('marketers')->user();
        return view('marketer-dashboard.index', compact('marketer'));
    }
}

