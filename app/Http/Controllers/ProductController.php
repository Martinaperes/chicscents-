<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Perfume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    /**
     * Display a listing of all products (grid view)
     */
    public function index(Request $request)
    {
        $query = Perfume::with('brand')->active();

        // Filter by type (decant/full) if specified
        if ($request->has('type')) {
            // This is a simplified filter - in reality you'd need to check the sizes JSON
            // For now, we'll just return all products and let the view handle it
        }

        // Filter by brand
        if ($request->has('brand')) {
            $query->where('brand_id', $request->brand);
        }

        // Filter by gender
        if ($request->has('gender')) {
            $query->where('gender', $request->gender);
        }

        // Sort options
        switch ($request->sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'bestsellers':
                $query->where('is_bestseller', true);
                break;
            default:
                $query->orderBy('name');
        }

        $perfumes = $query->paginate(12);
        
        // Get all brands for filter sidebar
        $brands = Brand::active()->get();

        return view('products.index', compact('perfumes', 'brands'));
    }

    /**
     * Display a single product with size selection
     */
    public function show($slug)
    {
        $perfume = Perfume::where('slug', $slug)->firstOrFail(); // ← Change to $perfume
    
    // Track this product
    $recent = json_decode(Cookie::get('recent_products', '[]'), true);
    array_unshift($recent, $perfume->id); // ← Change to $perfume
    $recent = array_unique($recent);
    $recent = array_slice($recent, 0, 5);
    Cookie::queue('recent_products', json_encode($recent), 10080); // 7 days
    
    return view('products.show', compact('perfume')); 
    
    
        $perfume = Perfume::with(['brand', 'reviews' => function($query) {
                $query->approved()->latest();
            }])
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Get related products (same brand or similar)
        $relatedPerfumes = Perfume::with('brand')
            ->active()
            ->where('id', '!=', $perfume->id)
            ->where('brand_id', $perfume->brand_id)
            ->inStock()
            ->take(4)
            ->get();

        return view('products.show', compact('perfume', 'relatedPerfumes'));
    }
    private function trackRecentView($productId)
{
    $recent = json_decode(Cookie::get('recent_products', '[]'), true);
    array_unshift($recent, $productId);
    $recent = array_unique($recent);
    $recent = array_slice($recent, 0, 5);
    Cookie::queue('recent_products', json_encode($recent), 10080);
}

    public function byOlfactoryFamily($family)
{
    // Comprehensive fragrance families based on perfumery knowledge
    $families = [
        'floral' => [
            'name' => 'Floral',
            'description' => 'The heart of perfumery, featuring romantic notes of rose, jasmine, and lily',
            'keywords' => ['rose', 'jasmine', 'lavender', 'violet', 'gardenia', 'tuberose', 'ylang', 'freesia', 'peony', 'orchid', 'lily', 'magnolia', 'frangipani', 'neroli', 'orange blossom', 'lilac', 'carnation', 'geranium', 'mimosa', 'osmanthus', 'iris', 'muguet']
        ],
        'woody' => [
            'name' => 'Woody',
            'description' => 'Warm, earthy notes of sandalwood, cedar, and vetiver for grounding sophistication',
            'keywords' => ['sandalwood', 'cedar', 'vetiver', 'patchouli', 'oakmoss', 'pine', 'cypress', 'agarwood', 'oud', 'guaiac', 'cashmeran', 'birch', 'rosewood', 'teak', 'fir', 'juniper', 'cedarwood']
        ],
        'oriental' => [
            'name' => 'Oriental',
            'description' => 'Rich, sensual notes of vanilla, amber, and exotic spices for evening allure',
            'keywords' => ['vanilla', 'amber', 'cinnamon', 'clove', 'nutmeg', 'cardamom', 'saffron', 'incense', 'frankincense', 'myrrh', 'benzoin', 'tonka', 'labdanum', 'ginger', 'pepper']
        ],
        'fresh' => [
            'name' => 'Fresh',
            'description' => 'Clean, invigorating citrus and aquatic notes for everyday freshness',
            'keywords' => ['citrus', 'bergamot', 'lemon', 'lime', 'orange', 'grapefruit', 'mandarin', 'aquatic', 'ocean', 'marine', 'sea', 'ozone', 'cucumber', 'melon', 'bamboo', 'salt', 'aldehydes', 'yuzu', 'tangerine']
        ],
        'green' => [
            'name' => 'Green',
            'description' => 'Crisp, natural notes of grass, leaves, and herbs for an earthy feel',
            'keywords' => ['green', 'grass', 'hay', 'mint', 'basil', 'rosemary', 'thyme', 'sage', 'tarragon', 'galbanum', 'ivy', 'fern', 'tea', 'matcha', 'fig leaf', 'tomato leaf', 'violet leaf']
        ],
        'fruity' => [
            'name' => 'Fruity',
            'description' => 'Juicy, sweet notes of berries, stone fruits, and tropical delights',
            'keywords' => ['berry', 'strawberry', 'raspberry', 'blueberry', 'blackberry', 'apple', 'pear', 'peach', 'apricot', 'plum', 'cherry', 'pineapple', 'mango', 'passion fruit', 'lychee', 'fig', 'pomegranate', 'watermelon']
        ],
        'gourmand' => [
            'name' => 'Gourmand',
            'description' => 'Delicious, edible notes of chocolate, vanilla, and caramel for sweet indulgence',
            'keywords' => ['chocolate', 'cocoa', 'coffee', 'caramel', 'toffee', 'honey', 'maple', 'almond', 'praline', 'hazelnut', 'coconut', 'milk', 'cream', 'sugar', 'cotton candy', 'marshmallow']
        ],
        'leather' => [
            'name' => 'Leather',
            'description' => 'Bold, sophisticated notes of fine leather and tobacco for distinctive character',
            'keywords' => ['leather', 'suede', 'tabac', 'tobacco', 'birch tar', 'styrax', 'cuir', 'smoked', 'burnt']
        ],
        'aromatic' => [
            'name' => 'Aromatic',
            'description' => 'Herbal, invigorating notes of lavender, rosemary, and fresh herbs',
            'keywords' => ['lavender', 'rosemary', 'thyme', 'sage', 'clary sage', 'mint', 'peppermint', 'spearmint', 'basil', 'anise', 'licorice', 'fougere', 'herbal', 'chamomile', 'verbena']
        ]
    ];

    // Check if family exists
    if (!isset($families[$family])) {
        abort(404);
    }

    $keywords = $families[$family]['keywords'];
    $familyName = $families[$family]['name'];
    $familyDescription = $families[$family]['description'];

    // Build the search query
    $perfumes = Perfume::with('brand')
        ->where(function($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('name', 'LIKE', "%{$keyword}%")
                      ->orWhere('short_description', 'LIKE', "%{$keyword}%")
                      ->orWhere('description', 'LIKE', "%{$keyword}%")
                      ->orWhere('notes', 'LIKE', "%{$keyword}%")
                      ->orWhere('top_notes', 'LIKE', "%{$keyword}%")
                      ->orWhere('heart_notes', 'LIKE', "%{$keyword}%")
                      ->orWhere('base_notes', 'LIKE', "%{$keyword}%");
            }
        })
        ->paginate(12);

    return view('olfactory-family', compact('perfumes', 'familyName', 'familyDescription', 'family', 'families'));
}
}