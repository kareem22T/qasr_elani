<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['building', 'street', 'floor', 'notes', 'is_default', 'area_id', 'city_id', 'user_id'];

    protected $appends = ['full_address'];

    protected $casts = ['is_default' => 'boolean'];


    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id')->withTrashed();
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getNotesAttribute($value)
    {
        return $value != null ? $value : '';
    }

    public function getFullAddressAttribute()
    {
        return $this->building . ' ' . $this->street . ' , ' . $this->area['name_' . app()->getLocale()] . ' , ' . $this->city['name_' . app()->getLocale()];
    }
}
