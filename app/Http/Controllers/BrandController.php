<?php

namespace App\Http\Controllers;

use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of all brands
     */
    public function index()
    {
        // Get all active brands with their perfume count
        $brands = Brand::withCount('perfumes')
            ->active()
            ->orderBy('name')
            ->get();

        return view('brands.index', compact('brands'));
    }

    /**
     * Display the specified brand and its perfumes
     */
    public function show($slug)
    {
        $brand = Brand::where('slug', $slug)
            ->active()
            ->with(['perfumes' => function($query) {
                $query->active()->latest();
            }])
            ->firstOrFail();

        return view('brands.show', compact('brand'));
    }
}