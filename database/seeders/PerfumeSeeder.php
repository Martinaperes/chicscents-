<?php

namespace Database\Seeders;

use App\Models\Perfume;
use App\Models\Brand;
use Illuminate\Database\Seeder;

class PerfumeSeeder extends Seeder
{
    public function run(): void
    {
        // First, create the Lattafa brand
        $lattafa = Brand::firstOrCreate(
            ['slug' => 'lattafa'],
            [
                'name' => 'Lattafa',
                'description' => 'Lattafa Perfumes is a renowned fragrance house from the United Arab Emirates, known for its exquisite oriental and western perfume creations.',
                'country' => 'UAE',
                'is_active' => true
            ]
        );

        // Create Elysia Vanilla Sweet Sugar
        Perfume::firstOrCreate(
            ['slug' => 'elysia-vanilla-sweet-sugar'],
            [
                'name' => 'Elysia Vanilla Sweet Sugar',
                'slug' => 'elysia-vanilla-sweet-sugar',
                'description' => 'A delightful and sweet fragrance that captures the essence of vanilla and sugar. Perfect for those who love gourmand scents that are both playful and sophisticated.',
                'short_description' => 'Sweet vanilla gourmand fragrance',
                'notes' => 'Vanilla • Sugar • Sweet Notes',
                'top_notes' => 'Sugar, Fruity Notes',
                'heart_notes' => 'Vanilla, Caramel',
                'base_notes' => 'Musk, Amber',
                'price' => 2500.00,
                'type' => 'full_bottle',
                'concentration' => 'Eau de Parfum',
                'volume' => 100,
                'gender' => 'Unisex',
                'season' => 'All Seasons',
                'occasion' => 'Casual, Daily Wear',
                'longevity' => 'Long Lasting 7-8 hours',
                'sillage' => 'Moderate',
                'stock_quantity' => 5,
                'is_active' => true,
                'is_featured' => true,
                'is_new' => true,
                'is_bestseller' => false,
                'brand_id' => $lattafa->id,
                'featured_image' => 'images\hero\elysia vanilla sugar.jpg', // Add image URL if available
            ]
        );

        // Create Khamrah
        Perfume::firstOrCreate(
            ['slug' => 'khamrah'],
            [
                'name' => 'Khamrah',
                'slug' => 'khamrah',
                'description' => 'A warm and spicy fragrance with notes of cinnamon, cardamom, and praline. Khamrah is a captivating scent that evokes the richness of Arabian nights.',
                'short_description' => 'Warm spicy oriental fragrance',
                'notes' => 'Cinnamon • Cardamom • Praline • Vanilla',
                'top_notes' => 'Cinnamon, Cardamom, Nutmeg',
                'heart_notes' => 'Praline, Vanilla, Dates',
                'base_notes' => 'Benzoin, Tonka Bean, Amber',
                'price' => 3300.00,
                'type' => 'full_bottle',
                'concentration' => 'Eau de Parfum',
                'volume' => 100,
                'gender' => 'Unisex',
                'season' => 'Fall, Winter',
                'occasion' => 'Evening, Special Occasions',
                'longevity' => 'Very Long Lasting 8-10 hours',
                'sillage' => 'Heavy',
                'stock_quantity' => 15,
                'is_active' => true,
                'is_featured' => true,
                'is_new' => true,
                'is_bestseller' => true,
                'brand_id' => $lattafa->id,
                'featured_image' => 'images/hero/khamrah.jpg', // Add image URL if available
            ]
        );

        // Create Ramz Lattafa Silver
        Perfume::firstOrCreate(
            ['slug' => 'ramz-lattafa-silver'],
            [
                'name' => 'Ramz Lattafa Silver',
                'slug' => 'ramz-lattafa-silver',
                'description' => 'An elegant and fresh fragrance with a blend of citrus, lavender, and woody notes. Ramz Silver offers a sophisticated scent profile perfect for any occasion.',
                'short_description' => 'Fresh and elegant woody fragrance',
                'notes' => 'Citrus • Lavender • Woods • Amber',
                'top_notes' => 'Bergamot, Lemon, Grapefruit',
                'heart_notes' => 'Lavender, Sage, Geranium',
                'base_notes' => 'Vetiver, Cedarwood, Amber, Musk',
                'price' => 2500.00,
                'type' => 'full_bottle',
                'concentration' => 'Eau de Parfum',
                'volume' => 100,
                'gender' => 'Men',
                'season' => 'Spring, Summer',
                'occasion' => 'Daily Wear, Office',
                'longevity' => 'Long Lasting 7-8 hours',
                'sillage' => 'Moderate',
                'stock_quantity' => 25,
                'is_active' => true,
                'is_featured' => true,
                'is_new' => false,
                'is_bestseller' => true,
                'brand_id' => $lattafa->id,
                'featured_image' => 'images\hero\ramz lataffa.jpg', // Add image URL if available
            ]
        );

        $this->command->info('Three perfumes have been added successfully!');
    }
}