<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // relasi
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('consultant_id')->constrained()->cascadeOnDelete();

            // data jadwal
            $table->date('date');          // 2025‑07‑01
            $table->time('time');          // 08:30:00

            // status: pending, approved, done, cancelled
            $table->enum('status', ['pending','approved','done','cancelled'])->default('pending');

            $table->timestamps();

            // ⇢ index agar pencarian slot cepat
            $table->unique(['consultant_id','date','time']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
