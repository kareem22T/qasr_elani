<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAd;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ProductsAdsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            ifHasAccess(9);
            return $next($request);
        });
    }

    public function index()
    {
        return View('admin.ProductsAds.index');
    }

    public function create()
    {
        $products = Product::whereNotIn('id', ProductAd::pluck('product_id'))->pluck((Session::has('local') ? 'name_' . Session::get('local') : 'name_ar'), 'id');
        return View('admin.ProductsAds.create', compact('products'));
    }

    public function store(Request $request, ProductAd $productAd)
    {
        $this->validate($request, $productAd->rules('add'));
        $productAd = $productAd->create($request->all());
        if ($request->hasFile('image')) {
            $productAd->addMediaFromRequest('image')->toMediaCollection();
        }
        return setRedirectWithMsg('create', 'admin/productAds');
    }

    public function edit(ProductAd $productAd)
    {
        $products = Product::whereNotIn('id', ProductAd::where('id', '<>', $productAd->id)->pluck('product_id'))->pluck((Session::has('local') ? 'name_' . Session::get('local') : 'name_ar'), 'id');
        return View('admin.ProductsAds.edit', compact('productAd', 'products'));
    }

    public function update(Request $request, ProductAd $productAd)
    {
        $this->validate($request, $productAd->rules('edit'));
        if ($request->hasFile('image')) {
            $productAd->clearMediaCollection();
            $productAd->addMediaFromRequest('image')->toMediaCollection();
        }
        $productAd->update($request->all());
        return setRedirectWithMsg('update', 'admin/productAds');
    }

    public function destroy(ProductAd $productAd)
    {
        $productAd->delete();
        return setRedirectWithMsg('delete', 'admin/productAds');
    }

    public function changeStatus(ProductAd $productAd)
    {
        if ($productAd->is_active == 0)
            $productAd->update(['is_active' => 1]);
        else if ($productAd->is_active == 1)
            $productAd->update(['is_active' => 0]);
        return setRedirectWithMsg('other', 'admin/productAds');
    }

    public function dataTable()
    {
        $productsAds = ProductAd::get();
        return DataTables::of($productsAds)->editColumn('control', function ($model) {
            $all = '<a href="' . url('/admin/products/' . $model->product_id) . '" class="btn btn-primary btn-circle"><i class="fa fa-eye-slash"></i></a> ';
            $all .= '<a href="' . url('/admin/productAds/' . $model->id . '/edit') . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';
            $all .= '<a href="' . url('/admin/productAds/' . $model->id . '/delete') . '" class="btn btn-danger btn-circle conf" id="deleteUser"><i class="fa fa-trash-o"></i></a>';
            return $all;
        })
            ->editColumn('product_name', function ($model) {
                return $model->product['name_' . Session::get('local')];
            })
            ->editColumn('created_at', function ($model) {
                $data = Carbon::parse($model->created_at)->toDateString();
                return $data;
            })
            ->editColumn('is_active', function ($model) {
                if ($model->is_active == 0) {
                    $all = '<button class="btn btn-danger btn-circle"> <i class="fa fa-ban"></i>' . trans('productsAds.block') . '</button> ';
                } else if ($model->is_active == 1) {
                    $all = '<button class="btn btn-success btn-circle"> <i class="fa fa-check"></i>' . trans('productsAds.activated') . '</button> ';
                }
                return $all;
            })
            ->editColumn('img', function ($model) {
                $all = '<img style="height:50px; width:50px;" src="' . $model->getFirstMediaUrl() . '">';
                return $all;
            })->rawColumns(['control', 'is_active', 'img'])->make(true);
    }
}
