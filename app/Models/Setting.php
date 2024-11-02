<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table    = 'settings';

    protected $fillable = ['email', 'phone', 'address', 'percent_added_tax', 'facebook', 'twitter', 'instagram', 'tiktok', 'terms_ar', 'terms_en', 'about_us_ar', 'about_us_en'];

    public function getFacebookAttribute($value)
    {
        return $value ?? '';
    }

    public function getTwitterAttribute($value)
    {
        return $value ?? '';
    }

    public function getInstagramAttribute($value)
    {
        return $value ?? '';
    }

    public function getTiktokAttribute($value)
    {
        return $value ?? '';
    }

    public function rules()
    {
        return [
            'email'              => ['required','email'],
            'phone'              => ['required'],
            'address'            => ['required'],
            'percent_added_tax'  => ['required','numeric','min:1','regex:/^\d+(\.\d{1,2})?$/'],
            'facebook'           => ['nullable','url'],
            'twitter'            => ['nullable','url'],
            'instagram'          => ['nullable','url'],
            'tiktok'             => ['nullable','url'],
            'terms_ar'           => ['required', 'string'],
            'terms_en'           => ['required', 'string'],
            'about_us_ar'        => ['required', 'string'],
            'about_us_en'        => ['required', 'string'],
        ];
    }

}
