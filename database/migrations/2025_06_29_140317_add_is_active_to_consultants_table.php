<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('consultants', function (Blueprint $table) {
            if (!Schema::hasColumn('consultants', 'working_hours')) {
                $table->string('working_hours', 20)->nullable()->after('rate');
            }
        });
    }

    public function down(): void
    {
        Schema::table('consultants', function (Blueprint $table) {
            if (Schema::hasColumn('consultants', 'working_hours')) {
                $table->dropColumn('working_hours');
            }
        });
    }
};

