<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('business_name', 150); // Razón Social
            $table->string('ruc', 11)->unique();  // RUC
            $table->string('phone', 20)->nullable();
            $table->string('email', 150)->nullable(); // <-- NUEVO
            $table->string('address', 255)->nullable(); // <-- NUEVO
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};