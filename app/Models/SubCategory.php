<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SubCategory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = ['name_ar', 'name_en', 'sort', 'category_id', 'is_active'];


    public function scopeActive($query)
    {
        return $query->whereIsActive(1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'sub_category_id', 'id');
    }

    public function rules($type = null)
    {
        return [
            'name_ar'   => ['required','string','max:80'],
            'name_en'   => ['required','string','max:80'],
            'sort'      => ['required', 'integer','min:1'],
            'image'     => ($type != 'edit') ? ['required','image','mimes:jpeg,png,jpg,gif,svg','max:20480'] : ['image','mimes:jpeg,png,jpg,gif,svg','max:20480'],
        ];
    }
}
