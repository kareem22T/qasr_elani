<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Api\ApiHelpersController;
use Validator;
use DB;

class ProductsController extends ApiHelpersController
{
    public function getSearchProducts(Request $request)
    {
        $rules = [
            'product_name' => ['nullable', 'string'],
            'sort_type'    => ['nullable', 'integer', 'between:0,6'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $products = Product::StockActive();
        if ($request->has('product_name') && (!(empty($request->product_name)) || $request->product_name != "")){
            $products = $products->where(function($q) use($request){
                $q->where('name_ar','LIKE', "%{$request->product_name}%")->orWhere('name_en','LIKE', "%{$request->product_name}%")
                  ->orWhere('desc_ar','LIKE', "%{$request->product_name}%")->orWhere('desc_en','LIKE', "%{$request->product_name}%");
            });
        }
        if ($request->has('sort_type') && $request->sort_type != '') {
            if ($request->sort_type == 0) {
                $products = $products->where('sale_price','!=',null)->orderByDesc('id');
            }elseif ($request->sort_type == 1) {
                $products = $products->orderByDesc('created_at');
            }elseif ($request->sort_type == 2) {
                $orderProductsIds = OrderProduct::select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->orderBy('total', 'DESC')->pluck('product_id')->toArray();
                if (count($orderProductsIds) > 0) {
                    $products = Product::whereIn('id',$orderProductsIds)->orderByRaw('FIELD(id,'.implode(",",$orderProductsIds).')');
                }

            }elseif ($request->sort_type == 3) {
                $products = $products->orderBy('name_'.app()->getLocale());
            }elseif ($request->sort_type == 4) {
                $products = $products->orderByDesc('name_'.app()->getLocale());
            }elseif ($request->sort_type == 5) {
                $products = $products->orderByRaw(DB::raw('IFNULL(sale_price, regular_price)'));
            }else {
                $products = $products->orderByRaw(DB::raw('IFNULL(sale_price, regular_price) desc'));
            }
        }
        $products = $products->simplePaginate(20);
        $data = [];
        $data['pagination_num'] = 20;
        $data['has_more']       = $products->hasMorePages();
        $data['products']       = [];
        foreach ($products as $product) {
            $productData = $this->returnProductData($product);
            unset($productData['stock'],  $productData['images']);
            array_push($data['products'], $productData);
        }
        return response()->api(true, 'successOperation', [], $data);
    }

    public function getProductsByType(Request $request)
    {
        $rules = [
            'type'            => ['required', 'integer', 'between:0,3'],
            'sub_category_id' => $request->type == 0 ? ['required', 'integer', 'min:1', 'exists:sub_categories,id'] : 'nullable',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $products = Product::StockActive();
        if ($request->type == 0) {
            $products = $products->where('sub_category_id',$request->sub_category_id)->orderByDesc('id');
        }elseif ($request->type == 1) {
            $products = $products->orderByDesc('created_at');
        }elseif ($request->type == 2) {
            $products = $products->where('is_recommended',1)->orderByDesc('id');
        }else{
            $products = $products->where('is_recommended',1)->orderByDesc('id');
        }
        $products = $products->simplePaginate(20);
        $data = [];
        $data['pagination_num'] = 20;
        $data['has_more']       = $products->hasMorePages();
        $data['products']       = [];
        foreach ($products as $product) {
            $productData = $this->returnProductData($product);
            unset($productData['stock'],  $productData['images']);
            array_push($data['products'], $productData);
        }
        return response()->api(true, 'successOperation', [], $data);
    }

    public function getProductDetails(Request $request)
    {
        $rules = [
            'product_id' => ['required', 'integer', 'min:1', 'exists:products,id'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $product = Product::find($request->product_id);
        if ($product->is_active != 1) {
            return response()->api(false, 'someErrorsHappened', 'productNotActive');
        }
        $product->increment('views');
        return response()->api(true, 'successOperation', [], $this->returnProductData($product));
    }
}
