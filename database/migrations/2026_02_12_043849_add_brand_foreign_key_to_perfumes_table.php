<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perfumes', function (Blueprint $table) {
            // First add the column
            $table->foreignId('brand_id')
                  ->nullable()
                  ->after('sku')
                  ->constrained('brands') // Explicitly reference brands table
                  ->nullOnDelete(); // If brand is deleted, set to null
        });
    }

    public function down(): void
    {
        Schema::table('perfumes', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropColumn('brand_id');
        });
    }
};