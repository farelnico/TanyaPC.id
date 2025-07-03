<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('consultants', 'working_hours')) {
            Schema::table('consultants', function (Blueprint $table) {
                // simpan sebagai VARCHAR, format "09:00-17:00"
                $table->string('working_hours', 20)->nullable()->after('rate');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('consultants', 'working_hours')) {
            Schema::table('consultants', function (Blueprint $table) {
                $table->dropColumn('working_hours');
            });
        }
    }
};
