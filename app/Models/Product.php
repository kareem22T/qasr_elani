<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = ['name_ar', 'name_en', 'desc_ar', 'desc_en', 'regular_price', 'sale_price', 'cashback', 'stock', 'sub_category_id', 'views', 'is_recommended', 'is_active'];

    protected $appends  = ['on_sale', 'discount', 'user_favourite'];

    public function scopeStockActive($query)
    {
        return $query->where('stock', '>', 0)->whereIsActive(1)->whereHas('subCategory', function ($query){
            $query->whereIsActive(1)->whereHas('category', function ($query){
                $query->whereIsActive(1);
            });
        });
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id')->withTrashed();
    }

    public function getCreatedAtAttribute($key)
    {
        return Carbon::parse($key)->format('d-m-Y g:i A');
    }


    public function getDiscountAttribute()
    {
        return $this->on_sale ? (float) number_format(($this->regular_price - $this->sale_price) / $this->regular_price * 100,2) : 0;
    }


    public function getOnSaleAttribute()
    {
        return $this->sale_price != null ? true : false;
    }

    public function getUserFavouriteAttribute()
    {
        $user = Auth::guard('users')->user();
        if ($user) {
            if ($user->favourites()->find($this->id)) {
                return true;
            }
            return false;
        }
        return false;
    }


    public function rules($type = null,$product = null)
    {
        return [
            'name_ar'          => ['required','string','max:255'],
            'name_en'          => ['required','string','max:255'],
            'desc_ar'          => ['required','string'],
            'desc_en'          => ['required','string'],
            'stock'            => ['required', 'integer','min:1'],
            'regular_price'    => ['required','numeric','min:1','regex:/^\d+(\.\d{1,2})?$/'],
            'sale_price'       => ['nullable','numeric','min:1','lt:regular_price','regex:/^\d+(\.\d{1,2})?$/'],
            'cashback'         => ['numeric','min:0','regex:/^\d+(\.\d{1,2})?$/'],
            'category_id'      => ['required','integer','min:1','exists:categories,id'],
            'sub_category_id'  => ['required','integer','min:1','exists:sub_categories,id'],
            'images'           => $type == 'add' || ($type == 'edit' && $product->getMedia()->count() == 0) ? ['required','array','max:5'] : ['nullable','array','max:5'],
            'images.*'         => ['image','mimes:jpeg,png,jpg,gif,svg','max:20480'],
            'is_recommended'   => ['required', 'integer', 'between:0,1'],
            'is_active'        => ['required', 'integer', 'between:0,1'],
        ];
    }

}
