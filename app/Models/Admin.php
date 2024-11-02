<?php

namespace App\Models;

use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Admin extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, InteractsWithMedia;

    protected $fillable = ['name', 'email', 'phone', 'password', 'group_id'];

    protected $hidden   = ['password', 'remember_token'];


    public function setPasswordAttribute($value)
    {
        if (!empty($value) && $value != null) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function getCreatedAtAttribute($key)
    {
        return Carbon::parse($key)->toFormattedDateString();
    }

    public function group()
    {
        return $this->belongsTo(Group::class,'group_id', 'id');
    }

    public function rules($type = 'add', $id = null)
    {
        return [
            'name'     => ['required','string','max:255'],
            'email'     => ($type == 'add') ? ['required', 'email', Rule::unique('admins')] : ['nullable', 'email', Rule::unique('admins')->ignore($id)],
            'phone'     => ($type == 'add') ? ['required', 'numeric', Rule::unique('admins')] : ['nullable', 'numeric', Rule::unique('admins')->ignore($id)],
            'password'  => ($type == 'add') ? ['required', 'min:8'] : ['nullable', 'min:8'],
        ];
    }
}
