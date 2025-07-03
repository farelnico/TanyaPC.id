<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consultants', function (Blueprint $table) {
            if (! Schema::hasColumn('consultants', 'mode')) {
                $table->enum('mode', ['online','offline','both'])
                      ->default('online')
                      ->after('rate');   // lokasi kolom
            }
        });
    }

    public function down(): void
    {
        Schema::table('consultants', function (Blueprint $table) {
            if (Schema::hasColumn('consultants', 'mode')) {
                $table->dropColumn('mode');
            }
        });
    }
};
