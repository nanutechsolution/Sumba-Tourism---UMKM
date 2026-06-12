<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // Relasi ke tabel villages (Desa)
            $table->foreignUuid('village_id')->constrained('villages')->cascadeOnDelete();
            
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('location_name')->nullable(); // Nama spesifik tempat, misal: "Lapangan Pasola"
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};