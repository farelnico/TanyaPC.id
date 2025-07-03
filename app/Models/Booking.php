<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    /* kolom yang boleh di‑isi mass‑assignment */
    protected $fillable = [
        'user_id',
        'consultant_id',
        'date',
        'time',
        'status',
        'zoom_link',
    ];

    /* ------------- RELASI ------------- */

    /** Booking → User */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** Booking → Consultant */
    public function consultant()
    {
        return $this->belongsTo(Consultant::class);
    }
    
}
