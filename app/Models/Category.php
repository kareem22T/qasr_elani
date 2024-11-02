<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = ['name_ar', 'name_en', 'sort', 'is_active'];


    public function scopeActive($query)
    {
        return $query->whereIsActive(1);
    }

    public function getCreatedAtAttribute($key)
    {
        return Carbon::parse($key)->toFormattedDateString();
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
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
