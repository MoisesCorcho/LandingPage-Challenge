<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('dni')->unique();
            $table->string('department');
            $table->string('city');
            $table->string('phone');
            $table->string('email')->unique();
            $table->timestamp('registered_at')->useCurrent();
            $table->string('password')->nullable();
            $table->boolean('is_winner')->default(false);
            $table->rememberToken();
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
