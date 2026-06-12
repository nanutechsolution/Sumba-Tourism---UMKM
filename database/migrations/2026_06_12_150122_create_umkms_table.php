<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // Relasi ke tabel villages (Desa)
            $table->foreignUuid('village_id')->constrained('villages')->cascadeOnDelete();
            
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category'); // Kuliner, Kriya, dll.
            $table->string('phone_number')->nullable();
            $table->longText('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('gallery')->nullable();
            $table->text('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};