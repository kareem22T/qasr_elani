<?php

namespace App\Http\Controllers\Api;

use App\Models\Area;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Api\ApiHelpersController;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class FavouritesController extends ApiHelpersController
{
    public function getAll()
    {
        $favouriteProducts = Auth::guard('users')->user()->favourites()->cursor();
        $data = [];
        foreach ($favouriteProducts as $product) {
            $productData = $this->returnProductData($product);
            unset($productData['stock'],  $productData['images']);
            array_push($data, $productData);
        }
        return response()->api(true, 'successOperation', [], $data);
    }

    public function addOrRemoveProduct(Request $request)
    {
        $rules = [
            'product_id' => ['required', 'integer', 'min:1', 'exists:products,id'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $product = Product::find($request->product_id);
        $isProductFavourite = Auth::guard('users')->user()->favourites()->find($product->id);
        if ($isProductFavourite) {
            Auth::guard('users')->user()->favourites()->detach($isProductFavourite);
        } else {
            Auth::guard('users')->user()->favourites()->attach($product->id);
        }
        return response()->api(true, 'successOperation', [], ['user_favourite' => $product->user_favourite]);
    }
}
