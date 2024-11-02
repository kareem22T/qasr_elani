<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use Auth;

class ProductsCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            ifHasAccess(8);
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.products.index');
    }

    public function create()
    {
        $categories = Category::pluck((Session::has('local') ? 'name_' . Session::get('local') : 'name_ar'), 'id');
        $subCategories = SubCategory::pluck((Session::has('local') ? 'name_' . Session::get('local') : 'name_ar'), 'id');
        return view('admin.products.create', compact('categories', 'subCategories'));
    }

    public function store(Request $request, Product $product)
    {
        $this->validate($request, $product->rules('add'));
        $product = $product->create($request->all());
        if ($request->hasFile('images')) {
            $product->addMultipleMediaFromRequest(['images'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection();
            });
        }
        if ($request->send_notifications == 1 && $product->is_active == 1) {
            pushNotification('new_product_added', ['productNameAr' => $product->name_ar, 'productNameEn' => $product->name_en], User::whereActivationCode(1)->get(), 4, $product->id, 0, Auth::guard('admins')->user()->id);
        }
        return setRedirectWithMsg('create', 'admin/products');
    }

    public function edit(Product $product)
    {
        $categories = Category::pluck((Session::has('local') ? 'name_' . Session::get('local') : 'name_ar'), 'id');
        $subCategories = SubCategory::pluck((Session::has('local') ? 'name_' . Session::get('local') : 'name_ar'), 'id');
        return view('admin.products.edit', compact('product', 'categories', 'subCategories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, $product->rules('edit', $product));
        $product->update($request->all());
        if ($request->hasFile('images')) {
            $product->addMultipleMediaFromRequest(['images'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection();
            });
        }
        return setRedirectWithMsg('update', 'admin/products');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return setRedirectWithMsg('delete', 'admin/products');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function deleteImage(Product $product, $id)
    {
        $product->deleteMedia($id);
        return redirect(url()->previous());
    }

    public function dataTable()
    {
        $categories = Product::get();
        return DataTables::of($categories)->editColumn('control', function ($model) {
            $all = '<a href="' . url('/admin/products/' . $model->id) . '" class="btn btn-primary btn-circle"><i class="fa fa-eye-slash"></i></a> ';
            $all .= '<a href="' . url('/admin/products/' . $model->id . '/edit') . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';
            $all .= '<a href="' . url('/admin/products/' . $model->id . '/delete') . '" class="btn btn-danger btn-circle conf" id="deleteUser"><i class="fa fa-trash-o"></i></a>';
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
            })->editColumn('discount', function ($model) {
                return $model->on_sale ? $model->discount . ' %' : '';
            })->editColumn('created_at', function ($model) {
                return Carbon::parse($model->created_at)->toDateString();
            })->editColumn('is_recommended', function ($model) {
                return $model->is_recommended == 1 ? trans('products.recommended') : trans('products.not_recommended');
            })
            ->editColumn('is_active', function ($model) {
                if ($model->is_active == 0) {
                    $all = '<button  class="btn btn-danger btn-circle"> <i class="fa fa-ban"></i>' . trans('products.block') . '</button> ';
                } else if ($model->is_active == 1) {
                    $all = '<button class="btn btn-success btn-circle"> <i class="fa fa-check"></i>' . trans('products.activated') . '</button> ';
                }
                return $all;
            })->rawColumns(['control', 'is_active'])->make(true);
    }

}
