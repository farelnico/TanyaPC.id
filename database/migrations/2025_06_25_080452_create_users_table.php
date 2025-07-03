<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id'); // bigint(20) UNSIGNED NOT NULL
            $table->string('name', 120); // varchar(120) NOT NULL
            $table->string('email', 120); // varchar(120) NOT NULL
            $table->string('phone', 20)->nullable(); // varchar(20) DEFAULT NULL
            $table->string('avatar', 255)->nullable(); // varchar(255) DEFAULT NULL
            $table->text('bio')->nullable(); // text DEFAULT NULL
            $table->string('password', 255); // varchar(255) NOT NULL
            $table->enum('role', ['admin', 'user'])->default('user'); // enum
            $table->rememberToken(); // varchar(100) DEFAULT NULL
            $table->timestamp('created_at')->useCurrent(); // DEFAULT current_timestamp()
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // ON UPDATE current_timestamp()
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
