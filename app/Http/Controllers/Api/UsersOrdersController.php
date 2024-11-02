<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiHelpersController;
use Validator;
use Illuminate\Support\Facades\Auth;

class UsersOrdersController extends ApiHelpersController
{
    public function getOrders()
    {
        $userOrders = Auth::guard('users')->user()->orders()->cursor();
        $data = [];
        foreach ($userOrders as $k => $order) {
            $data[$k]['id']          = $order->id;
            $data[$k]['number']      = $order->number;
            $data[$k]['status']      = $order->status_string;
            $data[$k]['total_price'] = $order->final_price;
            $data[$k]['created_at']  = $order->created_at;
        }
        return response()->api(true, 'successOperation', [], $data);
    }


    public function getOrderDetails(Request $request)
    {
        $rules = [
            'order_id' => ['required', 'integer', 'min:1', 'exists:orders,id'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $order  = Order::find($request->order_id);
        if ($order->user_id != Auth::guard('users')->user()->id){
            return response()->api(false, 'someErrorsHappened', 'orderNotToUser');
        }
        $data = [];
        $data['id']                    = $order->id;
        $data['number']                = $order->number;
        $data['status']                = $order->status_string;
        $data['reason_for_refused']    = $order->reason_for_refused;
        $data['shipping_address']      = $order->shipping_address;
        $data['sub_total']             = $order->products_price;
        $data['value_added_tax']       = $order->value_added_tax;
        $data['delivery_price']        = $order->delivery_price;
        $data['coupon_discount']       = $order->coupon_discount_money;
        $data['total_price']           = $order->final_price;
        $data['created_at']            = $order->created_at;
        $data['products'] = [];
        foreach ($order->products as $k => $orderProduct) {
            $data['products'][$k]['id']             = $orderProduct->product->id;
            $data['products'][$k]['name']           = $orderProduct->product['name_' . app()->getLocale()];
            $data['products'][$k]['first_image']    = $orderProduct->product->getFirstMediaUrl();
            $data['products'][$k]['piece_price']    = $orderProduct->piece_price;
            $data['products'][$k]['quantity_price'] = $orderProduct->quantity_price;
            $data['products'][$k]['qty']            = $orderProduct->qty;
        }
        return response()->api(true, 'successOperation', [], $data);
    }
}

