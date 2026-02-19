<?php

namespace App\Http\Controllers;

use App\Models\Perfume;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured perfumes that are active
        $featuredPerfumes = Perfume::with('brand')
            ->active()
            ->featured()
            ->latest()
            ->take(10)
            ->get();

        // If no featured perfumes exist, get some active perfumes as fallback
        if ($featuredPerfumes->isEmpty()) {
            $featuredPerfumes = Perfume::with('brand')
                ->active()
                ->inStock()
                ->latest()
                ->take(10)
                ->get();
        }

        // Return the view from home/index.blade.php
        return view('home.index', compact('featuredPerfumes'));
    }
}