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
        Schema::create('es_bot_questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->json('keywords');
            $table->enum('logic_operator', ['AND', 'OR'])->default('OR');
            $table->text('answer');
            $table->json('conditions')->nullable();
            $table->json('buttons')->nullable();
            $table->integer('priority')->default(0);
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('es_bot_questions');
    }
};
