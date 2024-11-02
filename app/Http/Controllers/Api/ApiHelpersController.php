<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use Lang;
use Illuminate\Support\Arr;
use Validator;
use App\Models\Order;

class ApiHelpersController extends Controller
{
    public function returnUserData($user)
    {
        $userArray = [];
        $userArray['id']       = $user->id;
        $userArray['name']     = $user->name;
        $userArray['email']    = $user->email;
        $userArray['phone']    = $user->phone;
        $userArray['image']    = $user->getFirstMediaUrl('images');
        $userArray['verified'] = $user->verified;
        return $userArray;
    }

    public function returnProductData($product)
    {
        $data = [];
        $data['id']             = $product->id;
        $data['name']           = $product['name_' . app()->getLocale()];
        $data['desc']           = $product['desc_' . app()->getLocale()];
        $data['first_image']    = $product->getFirstMediaUrl();
        $data['regular_price']  = $product->sale_price == null ? $product->regular_price : $product->sale_price;
        $data['on_sale']        = $product->on_sale;
        $data['sale_price']     = $product->sale_price != null ? $product->regular_price : 0;
        $data['discount']       = $product->discount;
        $data['stock']          = $product->stock;
        $data['user_favourite'] = $product->user_favourite;
        $data['images'] = [];
        foreach ($product->getMedia() as $k => $media) {
            $data['images'][$k]['id']    = $media->id;
            $data['images'][$k]['image'] = $media->getFullUrl();
        }
        return $data;
    }

    function generateOrderNumber() {
        $number = mt_rand(1000000000, 9999999999);
        if ($this->orderNumberExist($number)) {
            return $this->generateOrderNumber();
        }
        return $number;
    }

    function orderNumberExist($number) {
        return Order::whereNumber($number)->exists();
    }
}
