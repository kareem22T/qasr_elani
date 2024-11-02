<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProductAd extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['sort', 'product_id', 'is_active'];

    public function scopeActive($query)
    {
        return $query->whereIsActive(1)->whereHas('product', function ($query) {
            $query->where('stock', '>', 0)->whereIsActive(1)->whereHas('subCategory', function ($query) {
                $query->whereIsActive(1)->whereHas('category', function ($query) {
                    $query->whereIsActive(1);
                });
            });
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function rules($type = 'add')
    {
        return [
            'product_id' => ['required', 'integer', 'min:1', 'exists:products,id'],
            'sort'       => ['required', 'integer', 'min:1'],
            'image'      => ($type != 'edit') ? ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg','max:20480'] : ['image', 'mimes:jpeg,png,jpg,gif,svg','max:20480'],
        ];
    }
}
