<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking; 


class Consultant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','slug','specialization','bio','rate','photo','is_active','working_hours','mode', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

