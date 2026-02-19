<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('perfumes', function (Blueprint $table) {
        $table->decimal('decant_price', 10, 2)->nullable()->after('price');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perfumes', function (Blueprint $table) {
            //
        });
    }
};
