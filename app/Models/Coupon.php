<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Coupon extends Model
{
    protected $table    = 'coupons';

    protected $fillable = ['code', 'percent', 'date_from', 'date_to', 'is_active'];

    public function getDateFromAttribute($key)
    {
        return Carbon::parse($key)->format('Y-m-d');
    }

    public function getDateToAttribute($key)
    {
        return Carbon::parse($key)->format('Y-m-d');
    }

    public function getCreatedAtAttribute($key)
    {
        return Carbon::parse($key)->toFormattedDateString();
    }

    public function rules($type = 'add', $id = null)
    {
        return [
            'code'       => ($type == 'add') ? ['required', 'string','max:255', Rule::unique('coupons')] : ['required', 'string','max:255', Rule::unique('coupons')->ignore($id)],
            'percent'    => ['required','numeric','min:1','regex:/^\d+(\.\d{1,2})?$/'],
            'is_active'  => ['required', 'integer', 'between:0,1'],
        ];
    }

}
