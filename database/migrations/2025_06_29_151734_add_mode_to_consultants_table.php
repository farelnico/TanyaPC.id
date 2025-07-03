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
        Schema::table('consultants', function (Blueprint $table) {
            $table->enum('mode', ['online','offline','both'])
                ->default('online')->after('is_active');
        });
    }
    public function down(): void
    {
        Schema::table('consultants', fn ($t) => $t->dropColumn('mode'));
    }
};
