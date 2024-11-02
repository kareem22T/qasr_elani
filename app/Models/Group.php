<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable  = ['name','permissions'];

    public function setPermissionsAttribute($val)
    {
        $this->attributes['permissions'] = implode('|', $val);
    }
    public function rules()
    {
        return [
            'name'        => 'required',
            'permissions' => 'required|array',
        ];
    }

    public function getCreatedAtAttribute($key)
    {
        return Carbon::parse($key)->toFormattedDateString();
    }
}
