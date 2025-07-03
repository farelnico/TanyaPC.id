<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ubah definisi kolom status → tambahkan 'rejected'
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('status',
                ['pending','approved','rejected','done']
            )->default('pending')->change();
        });
    }

    public function down(): void
    {
        // kembali ke tiga status jika dibutuhkan
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('status',
                ['pending','approved','done']
            )->default('pending')->change();
        });
    }
};
