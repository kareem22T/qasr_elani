<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Area extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name_ar', 'name_en', 'delivery_price', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id')->withTrashed();
    }

    public function rules()
    {
        return [
            'name_ar'        => ['required','string','max:80'],
            'name_en'        => ['required','string','max:80'],
            'delivery_price' => ['required','numeric','min:1','regex:/^\d+(\.\d{1,2})?$/'],
        ];
    }

}
