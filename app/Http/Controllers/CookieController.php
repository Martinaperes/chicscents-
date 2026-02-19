<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookieController extends Controller
{
    /**
     * Track recently viewed products (KEEP THIS)
     */
    public function trackRecentView($productId)
    {
        $recent = json_decode(Cookie::get('recent_products', '[]'), true);
        array_unshift($recent, $productId);
        $recent = array_unique($recent);
        $recent = array_slice($recent, 0, 5);
        Cookie::queue('recent_products', json_encode($recent), 10080);
    }
    
    /**
     * Save user preferences (KEEP IF NEEDED)
     */
    public function savePreferences(Request $request)
    {
        $preferences = [
            'preferred_notes' => $request->input('preferred_notes', []),
            'price_range' => $request->input('price_range', 'all')
        ];
        
        Cookie::queue('user_preferences', json_encode($preferences), 43200);
        
        return response()->json(['success' => true]);
    }
}