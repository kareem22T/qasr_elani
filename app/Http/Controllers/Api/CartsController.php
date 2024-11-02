<?php

namespace App\Http\Controllers\Api;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Api\ApiHelpersController;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
class CartsController extends ApiHelpersController
{
    public function getCartDetails()
    {
        $userCartProducts   = Auth::guard('users')->user()->carts()->with('product')->get();
        $data = [];
        $data['sub_total'] = $userCartProducts->sum('quantity_price');
        $data['products']  = [];
        foreach ($userCartProducts as $k => $userCartProduct) {
            $data['products'][$k]['id']             = $userCartProduct->product->id;
            $data['products'][$k]['name']           = $userCartProduct->product['name_' . app()->getLocale()];
            $data['products'][$k]['first_image']    = $userCartProduct->product->getFirstMediaUrl();
            $data['products'][$k]['piece_price']    = $userCartProduct->piece_price;
            $data['products'][$k]['quantity_price'] = $userCartProduct->quantity_price;
            $data['products'][$k]['qty']            = $userCartProduct->qty;
            $data['products'][$k]['stock']          = $userCartProduct->product->stock;
            $data['products'][$k]['user_favourite'] = $userCartProduct->product->user_favourite;
        }
        return response()->api(true, 'successOperation', [], $data);
    }

    public function addProductToCart(Request $request)
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
        $isProductExistInCart = Auth::guard('users')->user()->carts()->whereProductId($product->id)->first();
        $productPrice = $product->sale_price != null ? $product->sale_price : $product->regular_price;
        $qty = $isProductExistInCart ? $isProductExistInCart->qty + 1 : 1;
        if ($product->stock < $qty) {
            return response()->api(false, 'someErrorsHappened', 'qtyNotAvailable');
        }
        if ($product->stock >= 10 && $qty > 10) {
            return response()->api(false, 'someErrorsHappened', 'maxQtyTen');
        }
        if ($isProductExistInCart) {
            $isProductExistInCart->update([
                'qty'            => $qty,
                'piece_price'    => $productPrice,
                'quantity_price' => $qty * $productPrice,
            ]);
        } else {
            Auth::guard('users')->user()->carts()->create([
                'qty' => $qty,
                'piece_price'    => $productPrice,
                'quantity_price' => $productPrice,
                'product_id'     => $product->id,
            ]);
        }
        $data = ['cart_products_count' => Auth::guard('users')->user()->cart_products_count];
        return response()->api(true, 'successOperation', [], $data);
    }

    public function updateProductQty(Request $request)
    {
        $rules = [
            'product_id' => ['required', 'integer', 'min:1', 'exists:products,id'],
            'qty'        => ['required', 'integer', 'min:1', 'max:10'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $product = Product::find($request->product_id);
        $isProductExistInCart = Auth::guard('users')->user()->carts()->whereProductId($product->id)->first();
        if (!$isProductExistInCart) {
            return response()->api(false, 'someErrorsHappened', 'productNotInCart');
        }
        $productPrice = $product->sale_price != null ? $product->sale_price : $product->regular_price;
        if ($product->stock < $request->qty) {
            return response()->api(false, true, 'someErrorsHappened', 'qtyNotAvailable');
        }
        $isProductExistInCart->update([
            'qty'            => $request->qty,
            'piece_price'    => $productPrice,
            'quantity_price' => $request->qty * $productPrice,
        ]);
        $data = [];
        $data['sub_total'] = Auth::guard('users')->user()->carts()->sum('quantity_price');
        return response()->api(true, 'successOperation', [], $data);

    }

    public function deleteProductFromCart(Request $request)
    {
        $rules = [
            'product_id' => ['required', 'integer', 'min:1', 'exists:products,id'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $product = Product::find($request->product_id);
        $isProductExistInCart = Auth::guard('users')->user()->carts()->whereProductId($product->id)->first();
        if (!$isProductExistInCart) {
            return response()->api(false, 'someErrorsHappened', 'productNotInCart');
        }
        $isProductExistInCart->delete();
        $data = ['cart_products_count' => Auth::guard('users')->user()->cart_products_count];
        return response()->api(true, 'successOperation', [], $data);
    }

    public function getCheckoutDetails(Request $request)
    {
        $rules = [
            'coupon_code' => ['nullable', 'string', 'exists:coupons,code'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }

        $userCartProducts   = Auth::guard('users')->user()->carts()->select('quantity_price')->get();
        $defaultUserAddress = Auth::guard('users')->user()->addresses()->whereIsDefault(1)->first();
        $subTotal           = round($userCartProducts->sum('quantity_price'), 2);
        $value_added_tax    = round($subTotal * (Setting::select('percent_added_tax')->first()->percent_added_tax / 100), 2);
        $delivery_price     = $defaultUserAddress ? round($defaultUserAddress->area->delivery_price,2) : 0;
        $couponDiscount     = 0;
        $subTotalWithValue = round($subTotal + $value_added_tax,2);

        if ($request->has('coupon_code') && $request->coupon_code != null) {
            $coupon = Coupon::whereCode($request->coupon_code)->first();

            if ($coupon->is_active != 1) {
                return response()->api(false, 'someErrorsHappened', 'couponNotActive');
            }

            if (!Carbon::today()->between($coupon->date_from,$coupon->date_to))
            {
                return response()->api(false, 'someErrorsHappened', 'couponExpire');
            }
            $couponDiscount    = round($subTotalWithValue * ($coupon->percent / 100), 2);
            $subTotalWithValue = round($subTotalWithValue - $couponDiscount, 2);
        }
        $data = [];
        $data['user_default_address']  = $defaultUserAddress ? $defaultUserAddress->full_address : '';
        $data['sub_total']             = $subTotal;
        $data['value_added_tax']       = $value_added_tax;
        $data['delivery_price']        = $delivery_price;
        $data['coupon_discount']       = $couponDiscount;
        $data['total_price']           = round($subTotalWithValue + $delivery_price,2);
        return response()->api(true, 'successOperation', [], $data);
    }

    public function checkCouponCode(Request $request)
    {
        $rules = [
            'coupon_code' => ['required', 'string', 'exists:coupons,code'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $userCartProducts   = Auth::guard('users')->user()->carts()->select('quantity_price')->get();

        if ($userCartProducts->count() == 0) {
            return response()->api(false, 'someErrorsHappened', 'usrHveNoCart');
        }
        $coupon = Coupon::whereCode($request->coupon_code)->first();

        if ($coupon->is_active != 1) {
            return response()->api(false, 'someErrorsHappened', 'couponNotActive');
        }

        if (!Carbon::today()->between($coupon->date_from,$coupon->date_to))
        {
            return response()->api(false, 'someErrorsHappened', 'couponExpire');
        }

        $defaultUserAddress = Auth::guard('users')->user()->addresses()->whereIsDefault(1)->first();
        $subTotal           = round($userCartProducts->sum('quantity_price'), 2);
        $value_added_tax    = round($subTotal * (Setting::select('percent_added_tax')->first()->percent_added_tax / 100), 2);
        $delivery_price     = $defaultUserAddress ? round($defaultUserAddress->area->delivery_price,2) : 0;
        $subTotalWithValue  = round($subTotal + $value_added_tax, 2);
        $couponDiscount     = round($subTotalWithValue * ($coupon->percent / 100), 2);

        $data = [];
        $data['sub_total']             = $subTotal;
        $data['value_added_tax']       = $value_added_tax;
        $data['delivery_price']        = $delivery_price;
        $data['coupon_discount']       = $couponDiscount;
        $data['total_price']           = round(($subTotalWithValue - $couponDiscount) + $delivery_price, 2);
        return response()->api(true, 'successOperation', [], $data);
    }

    public function checkout(Request $request)
    {
        $userCartProducts  = Auth::guard('users')->user()->carts();
        if ($userCartProducts->count() == 0) {
            return response()->api(false, 'someErrorsHappened', 'usrHveNoCart');
        }
        $defaultUserAddress = Auth::guard('users')->user()->addresses()->whereIsDefault(1)->first();
        if (!$defaultUserAddress){
            return response()->api(false, 'someErrorsHappened', 'mustHaveDefaultAddress');
        }
        $rules = [
            'coupon_code' => ['nullable', 'string', 'exists:coupons,code'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        DB::beginTransaction();
        try {
            $subTotal         = (float) number_format($userCartProducts->sum('quantity_price'), 2);
            $value_added_tax  = (float) number_format($subTotal * (Setting::select('percent_added_tax')->first()->percent_added_tax / 100), 2);
            $delivery_price   = (float) number_format($defaultUserAddress->area->delivery_price,2);
            $totalPrice       = (float) number_format($subTotal + $value_added_tax, 2);
            if ($request->has('coupon_code') && $request->coupon_code != null) {
                $coupon = Coupon::whereCode($request->coupon_code)->first();
                if ($coupon->is_active != 1) {
                    return response()->api(false, 'someErrorsHappened', 'couponNotActive');
                }
                if (!Carbon::today()->between($coupon->date_from,$coupon->date_to))
                {
                    return response()->api(false, 'someErrorsHappened', 'couponExpire');
                }
                $request->merge(['coupon_code'           => $coupon->code]);
                $request->merge(['coupon_percent'        => $coupon->percent]);
                $request->merge(['coupon_discount_money' => (float) number_format($totalPrice * ($coupon->percent / 100), 2)]);
                $totalPrice = (float) number_format($totalPrice - ($totalPrice * ($coupon->percent / 100)), 2);
            }
            $request->merge(['number'           => $this->generateOrderNumber()]);
            $request->merge(['products_price'   =>  $subTotal]);
            $request->merge(['value_added_tax'  => $value_added_tax]);
            $request->merge(['delivery_price'   => $delivery_price]);
            $request->merge(['final_price'      => (float) number_format($totalPrice + $delivery_price ,2)]);
            $request->merge(['user_address_id'  => $defaultUserAddress->id]);
            $request->merge(['status'           => 0]);
            $order = Auth::guard('users')->user()->orders()->create($request->all());
            $cartProducts = $userCartProducts->select('qty', 'piece_price', 'quantity_price', 'product_id')->get()->toArray();
            $order->products()->createMany($cartProducts);
            $orderProducts = $order->products()->get();
            foreach ($orderProducts as $orderProduct) {
                Product::find($orderProduct->product_id)->decrement('stock', $orderProduct->qty);
            }
            Auth::guard('users')->user()->carts()->delete();
            DB::commit();
            return response()->api(true, 'successOperation', [], ['order_id' => $order->id]);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->api(false, 'someErrorsHappened', $ex->getMessage());
        }
    }
}
