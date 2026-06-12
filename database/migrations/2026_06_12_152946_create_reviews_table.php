<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // Relasi ke destinasi (harus UUID)
            $table->foreignUuid('destination_id')->constrained('destinations')->cascadeOnDelete();
            
            $table->string('reviewer_name');
            $table->integer('rating')->default(5); // Rating 1 sampai 5
            $table->text('comment');
            $table->boolean('is_approved')->default(true); // Fitur moderasi (bisa disembunyikan admin)
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};