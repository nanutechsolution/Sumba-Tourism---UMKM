<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->longText('history')->nullable()->after('description');
            $table->longText('culture')->nullable()->after('history');
            $table->longText('myth')->nullable()->after('culture');
            $table->longText('tradition')->nullable()->after('myth');
        });
    }

    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn(['history', 'culture', 'myth', 'tradition']);
        });
    }
};