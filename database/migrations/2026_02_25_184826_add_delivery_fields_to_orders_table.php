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
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'delivery_zone')) {
                $table->string('delivery_zone')->nullable()->after('county');
            }
            if (!Schema::hasColumn('orders', 'mtaani_location')) {
                $table->string('mtaani_location')->nullable()->after('pickup_location');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['delivery_zone', 'mtaani_location']);
        });
    }
};
