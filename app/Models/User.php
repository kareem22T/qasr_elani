<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia, SoftDeletes;

    protected $fillable = ['name', 'email', 'phone', 'password', 'activation_code', 'current_lang', 'send_notifications', 'device_type', 'firebase_token', 'marketer_id'];

    protected $hidden = ['password', 'remember_token'];

    protected $appends = ['verified', 'cart_products_count'];

    protected $casts = ['send_notifications' => 'boolean'];


    public function setPasswordAttribute($value)
    {
        if (!empty($value) && $value != null) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function getVerifiedAttribute()
    {
        return $this->activation_code != 1 ? 2 : intval($this->activation_code);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id')->orderByDesc('id');
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class, 'user_id', 'id')->orderByDesc('id');
    }

    public function marketer()
    {
        return $this->belongsTo(Marketer::class, 'marketer_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(NotificationUser::class, 'user_id', 'id')->orderByDesc('id');
    }

    public function favourites()
    {
        return $this->belongsToMany(Product::class, 'favorites');
    }

    public function getCartProductsCountAttribute()
    {
        return $this->carts()->count();
    }

    public function rules($type = 'edit', $id = null)
    {

        return [
            'name' => ['required', 'string'],
            'email' => ($type == 'add') ? ['required', 'email', Rule::unique('users')] : ['required', 'email', Rule::unique('users')->ignore($id)],
            'phone' => ($type == 'add') ? ['required', 'numeric', Rule::unique('users')] : ['required', 'numeric', Rule::unique('users')->ignore($id)],
            'password' => ($type == 'add') ? ['required', 'min:8'] : ['nullable', 'min:8'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg'],
        ];
    }

}
