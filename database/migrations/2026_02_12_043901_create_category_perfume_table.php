<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_perfume', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perfume_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['perfume_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_perfume');
    }
};