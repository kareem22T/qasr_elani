<?php

namespace App\Http\Controllers\Marketer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['permission:الروشتات,admins']);
    }

    public function index()
    {
        return view('marketer-dashboard.modules.products.index');
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('marketer-dashboard.modules.products.show', compact('product'));
    }

    public function dataTable()
    {
        $products = Product::StockActive()->latest();
        return DataTables::of($products)->editColumn('control', function ($model) {
            $all  = '<a href="' . url('/marketer/products-marketer/' . $model->id) . '" class="btn btn-primary btn-circle"><i class="fa fa-eye-slash"></i></a> ';
            $all .= '<a target = "_blank" href="' . url('https://becleopatra.vercel.app/product/' . $model->id . '?referral_code='. auth('marketers')->user()->referral_code) . '" class="btn btn-warning btn-circle"><i class="fa fa-share"></i></a> ';
            return $all;
        })
            ->editColumn('name', function ($model) {
                return $model['name_' . Session::get('local')];
            })->editColumn('category', function ($model) {
                return $model->subCategory->category['name_' . Session::get('local')];
            })->editColumn('sub_category', function ($model) {
                return $model->subCategory['name_' . Session::get('local')];
            })->editColumn('final_price', function ($model) {
                return $model->on_sale ? $model->sale_price : $model->regular_price;
            })->editColumn('created_at', function ($model) {
                return Carbon::parse($model->created_at)->toDateString();
            })->rawColumns(['control'])->make(true);
    }
}
