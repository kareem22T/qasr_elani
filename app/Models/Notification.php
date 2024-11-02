<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['body_ar', 'body_en', 'type', 'notify_type', 'redirect_id', 'admin_id'];

    public function users()
    {
        return $this->hasMany(NotificationUser::class, 'notification_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function getCreatedAtAttribute($key)
    {
        if (request()->segment(1) == 'api') {
            return Carbon::parse($key)->diffForHumans();
        }
        return Carbon::parse($key)->format('d-m-Y g:i A');
    }

    public function rules()
    {
        return [
            'body_ar'  => 'required|string',
            'body_en'  => 'required|string',
        ];
    }
}
