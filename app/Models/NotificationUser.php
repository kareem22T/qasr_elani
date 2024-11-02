<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{
    use HasFactory;

    protected $fillable = ['notification_id', 'user_id'];

    public function getCreatedAtAttribute($key)
    {
        if (request()->segment(1) == 'api') {
            return Carbon::parse($key)->diffForHumans();
        }
        return Carbon::parse($key)->format('d-m-Y g:i A');
    }

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'notification_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
