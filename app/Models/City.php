<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name_ar', 'name_en'];

    public function areas()
    {
        return $this->hasMany(Area::class, 'city_id', 'id');
    }

    public function rules()
    {
        return [
            'name_ar'  => ['required', 'string', 'max:80'],
            'name_en'  => ['required', 'string', 'max:80'],
        ];
    }
}
