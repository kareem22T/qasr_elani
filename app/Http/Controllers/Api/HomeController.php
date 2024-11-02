<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductAd;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
class HomeController extends ApiHelpersController
{
    public function home()
    {
        $categories          = Category::Active()->whereHas('subCategories', function ($subCat) {$subCat->whereIsActive(1);})->orderBy('sort')->take(8)->cursor();
        $productsAds         = ProductAd::with("product")->Active()->orderBy('sort')->cursor();
        $newProducts         = Product::StockActive()->orderByDesc('created_at')->take(8)->cursor();
        $orderProductsIds    = OrderProduct::select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->orderBy('total', 'DESC')->pluck('product_id')->toArray();
        $recommendedProducts = Product::StockActive()->whereIsRecommended(1)->orderByDesc('id')->take(8)->cursor();
        $user                = Auth::guard('users')->user();
        $countCartProducts   = $user != null ? $user->cart_products_count : 0;
        $home_list['show_location'] = true;$home_list['cart_products_count'] = $countCartProducts; $home_list['products_ads'] = [];$home_list['categories']   = [];
        $home_list['new_products']  = [];$home_list['best_selling_products'] = [];$home_list['recommended_products'] = [];
        if ($productsAds->count()) {
            foreach ($productsAds as $k => $productsAd) {
                $home_list['products_ads'][$k]['id']    = $productsAd->product_id;
                $home_list['products_ads'][$k]['image'] = $productsAd->getFirstMediaUrl();
                $home_list['products_ads'][$k]['product'] = $productsAd->product;
            }
        }
        if ($categories->count()) {
            foreach ($categories as $k => $category) {
                $home_list['categories'][$k]['id']   = $category->id;
                $home_list['categories'][$k]['name'] = $category['name_' . app()->getLocale()];
                $home_list['categories'][$k]['logo'] = $category->getFirstMediaUrl();
            }
        }
        if ($newProducts->count()) {
            foreach ($newProducts as $product) {
                $productData = $this->returnProductData($product);
                unset($productData['stock'],  $productData['images']);
                array_push($home_list['new_products'], $productData);
            }
        }
        if (count($orderProductsIds) > 0) {
            $bestSellingProducts = Product::StockActive()->whereIn('id',$orderProductsIds)->take(5)->orderByRaw('FIELD(id,'.implode(",",$orderProductsIds).')')->cursor();
            foreach ($bestSellingProducts as $bestSellingProduct) {
                $productData = $this->returnProductData($bestSellingProduct);
                unset($productData['stock'],  $productData['images']);
                array_push($home_list['best_selling_products'], $productData);
            }
        }
        if ($recommendedProducts->count()) {
            foreach ($recommendedProducts as $product) {
                $productData = $this->returnProductData($product);
                unset($productData['stock'],  $productData['images']);
                array_push($home_list['recommended_products'], $productData);
            }
        }
        return response()->api(true, 'successOperation', [], $home_list);
    }
}
