<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perfume;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        $products = Perfume::with(['brand', 'categories'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);

        $validated['slug'] = Str::slug($validated['name']) . '-' . uniqid();
        
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('products', 'public');
            $validated['featured_image'] = '/storage/' . $path;
        }

        Perfume::create($validated);

        return redirect()->route('admin.products')->with('success', 'Fragrance added to collection.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Perfume $product)
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'brands', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Perfume $product)
    {
        $validated = $this->validateProduct($request, $product->id);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('products', 'public');
            $validated['featured_image'] = '/storage/' . $path;
        }

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Perfume $product)
    {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product removed from collection.');
    }

    /**
     * Shared validation logic for products.
     */
    protected function validateProduct(Request $request, $id = null)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'decant_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:255',
            'type' => 'required|string',
            'gender' => 'required|string',
            'concentration' => 'nullable|string',
            'volume' => 'nullable|integer',
            'sku' => 'nullable|string|unique:perfumes,sku' . ($id ? ",$id" : ""),
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'notes' => 'nullable|string',
            'top_notes' => 'nullable|string',
            'heart_notes' => 'nullable|string',
            'base_notes' => 'nullable|string',
            'season' => 'nullable|string',
            'occasion' => 'nullable|string',
            'longevity' => 'nullable|string',
            'sillage' => 'nullable|string',
        ]);
    }
}
