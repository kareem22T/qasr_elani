<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'message', 'status', 'notes'];

    public function getCreatedAtAttribute($key)
    {
        return Carbon::parse($key)->toFormattedDateString();
    }
}
