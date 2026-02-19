<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfume;
use App\Models\Brand;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            $query = $request->get('q');
            
            if (!$query || strlen($query) < 1) {
                return response()->json([]);
            }

            // Search in perfumes
            $perfumes = Perfume::with('brand')
                ->where(function($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                      ->orWhere('short_description', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%")
                      ->orWhere('notes', 'LIKE', "%{$query}%")
                      ->orWhere('top_notes', 'LIKE', "%{$query}%")
                      ->orWhere('heart_notes', 'LIKE', "%{$query}%")
                      ->orWhere('base_notes', 'LIKE', "%{$query}%");
                })
                ->limit(10)
                ->get();

            // If no perfumes found, try searching brands separately
            if ($perfumes->isEmpty()) {
                $brands = Brand::where('name', 'LIKE', "%{$query}%")->pluck('id');
                
                if ($brands->isNotEmpty()) {
                    $perfumes = Perfume::with('brand')
                        ->whereIn('brand_id', $brands)
                        ->limit(10)
                        ->get();
                }
            }

            // Format the response with proper data types
            $formattedPerfumes = $perfumes->map(function($perfume) {
                // Ensure prices are floats/numbers
                $price = is_numeric($perfume->price) ? (float)$perfume->price : 0;
                $decantPrice = is_numeric($perfume->decant_price) ? (float)$perfume->decant_price : null;
                
                return [
                    'id' => (int)$perfume->id,
                    'name' => (string)$perfume->name,
                    'slug' => (string)$perfume->slug,
                    'price' => $price,
                    'decant_price' => $decantPrice,
                    'featured_image' => $perfume->featured_image ? asset($perfume->featured_image) : null,
                    'brand' => $perfume->brand ? [
                        'id' => (int)$perfume->brand->id,
                        'name' => (string)$perfume->brand->name,
                        'slug' => (string)$perfume->brand->slug
                    ] : null
                ];
            });

            return response()->json($formattedPerfumes);

        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            return response()->json(['error' => 'Search failed'], 500);
        }
    }
}