<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of brands.
     */
    public function index()
    {
        $brands = Brand::withCount('perfumes')->orderBy('name')->paginate(15);
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new brand.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created brand in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'description' => 'nullable|string',
        ]);

        Brand::create($validated);

        return redirect()->route('admin.brands')->with('success', 'Brand added successfully.');
    }

    /**
     * Show the form for editing the specified brand.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified brand in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'description' => 'nullable|string',
        ]);

        $brand->update($validated);

        return redirect()->route('admin.brands')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified brand from storage.
     */
    public function destroy(Brand $brand)
    {
        if ($brand->perfumes()->count() > 0) {
            return back()->with('error', 'Cannot delete brand with associated products.');
        }
        $brand->delete();
        return redirect()->route('admin.brands')->with('success', 'Brand deleted.');
    }
}
