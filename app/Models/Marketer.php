<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Marketer extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'phone', 'address', 'password', 'referral_code', 'balance', 'is_default'];

    protected $hidden = ['password', 'remember_token'];

    public function setPasswordAttribute($value)
    {
        if (!empty($value) && $value != null) {
            $this->attributes['password'] = Hash::make($value);
        }
    }
}
