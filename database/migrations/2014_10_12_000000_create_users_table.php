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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastName')->default('');
            $table->string('dni')->unique();
            $table->string('department');
            $table->string('city');
            $table->string('phone');
            $table->string('email')->unique();
            $table->timestamp('added_at');
            $table->string('password')->default('');
            $table->string('is_winner')->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
