<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['number','coupon_code', 'coupon_percent', 'coupon_discount_money', 'products_price', 'value_added_tax', 'delivery_price', 'final_price', 'status', 'reason_for_refused', 'user_address_id', 'user_id'];

    protected $appends  = ['shipping_address', 'status_string'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }

    public function userAddress()
    {
        return $this->belongsTo(UserAddress::class, 'user_address_id', 'id')->withTrashed();
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    public function getCreatedAtAttribute($key)
    {
        return Carbon::parse($key)->format('Y-m-d g:i A');
    }

    public function getNumberAttribute($value)
    {
        return '#' . $value;
    }

    public function getShippingAddressAttribute()
    {
        return $this->userAddress->full_address;
    }

    public function getCouponDiscountMoneyAttribute($value)
    {
        return $value ?? 0;
    }

    public function getReasonForRefusedAttribute($value)
    {
        return $this->status == 5 && $value != null ? $value : '';
    }

    public function getStatusStringAttribute()
    {
        $arrEn = ['pending','request accepted','request being prepared','connecting is in progress','request delivered','request canceled'];
        $arrAr = ['قيد الانتظار','تم قبول الطلب','جاري تحضير الطلب','جاري التوصيل','تم تسليم الطلب','تم الغاء الطلب'];
        $array = app()->getLocale() == 'en' ? $arrEn : $arrAr;
        return $array[$this->status];

    }

}
