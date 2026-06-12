<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Utama Paket Perjalanan
        Schema::create('itineraries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name'); // Contoh: "Eksplor Sumba Barat Daya 3H2M"
            $table->string('slug')->unique();
            $table->integer('duration_days'); // Contoh: 3
            $table->longText('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->decimal('estimated_budget', 12, 2)->nullable(); // Estimasi biaya
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Tabel Pivot (Many-to-Many) antara Itinerary dan Destinasi
        Schema::create('destination_itinerary', function (Blueprint $table) {
            $table->id();
            // Hubungkan ke UUID itinerary
            $table->foreignUuid('itinerary_id')->constrained('itineraries')->cascadeOnDelete();
            // Hubungkan ke UUID destination
            $table->foreignUuid('destination_id')->constrained('destinations')->cascadeOnDelete();
            
            // Kolom tambahan di pivot untuk menentukan hari ke berapa destinasi ini dikunjungi
            $table->integer('day')->default(1); 
            $table->integer('order_index')->default(0); // Urutan kunjungan pada hari tersebut
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destination_itinerary');
        Schema::dropIfExists('itineraries');
    }
};