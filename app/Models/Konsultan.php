<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsultan extends Model
{
    protected $table = 'konsultans'; // Sesuaikan dengan nama tabel di database
    protected $fillable = ['nama', 'rating', 'jadwal_terdekat', 'foto', 'review']; // Sesuaikan kolom
}
