<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perfumes', function (Blueprint $table) {
            $table->id();
            
            // Basic Information
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('short_description')->nullable();
            
            // Pricing
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->timestamp('discount_ends_at')->nullable();
            
            // Classification
            $table->string('type'); 
            $table->string('concentration')->nullable();
            $table->integer('volume')->nullable();
            $table->string('sku')->unique()->nullable();
            
            // Brand Foreign Key - REMOVED FROM HERE
            // $table->foreignId('brand_id')->nullable()->constrained();
            
            // Scent Profile
            $table->text('notes')->nullable();
            $table->string('top_notes')->nullable();
            $table->string('heart_notes')->nullable();
            $table->string('base_notes')->nullable();
            
            // Target Audience
            $table->string('gender')->default('Unisex');
            $table->string('season')->nullable();
            $table->string('occasion')->nullable();
            
            // Performance
            $table->string('longevity')->nullable();
            $table->string('sillage')->nullable();
            
            // Inventory
            $table->integer('stock_quantity')->default(0);
            $table->integer('sold_count')->default(0);
            
            // Status Flags
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_bestseller')->default(false);
            
            // Media
            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('video_url')->nullable();
            
            // Reviews
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->integer('review_count')->default(0);
            
            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfumes');
    }
};