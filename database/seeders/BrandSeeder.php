<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        
        $brands = [
            [
                'name' => 'Lattafa',
                'description' => 'Lattafa Perfumes is a renowned fragrance house from the United Arab Emirates, known for its exquisite oriental and western perfume creations. Their fragrances are celebrated for exceptional longevity, complex compositions, and incredible value.',
                'logo' => 'images/hero/lattafa.png',
                'website' => 'https://lattafa.com',
                'country' => 'UAE',
                'founded_year' => 1980,
                'is_active' => true
            ],
            
            
        ];

        foreach ($brands as $brand) {
            $brand['slug'] = Str::slug($brand['name']);
            Brand::create($brand);
        }

        $this->command->info('Brands seeded successfully!');
    }
}