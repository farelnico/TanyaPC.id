<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**  Tambahkan kolom saat migrate  */
    public function up(): void
    {
        Schema::table('consultants', function (Blueprint $table) {
            $table->string('type', 20)->default('online')->after('rate');
            // nilai default 'online' supaya data lama tetap valid
        });
    }

    /**  Hapus kolom saat rollback  */
    public function down(): void
    {
        Schema::table('consultants', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
