<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Perfume;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }
            Auth::logout();
            return back()->withErrors(['email' => 'Access denied. Only administrators can enter.']);
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $total_orders = Order::count();
        $total_sales = Order::where('payment_status', 'paid')->sum('total_amount');
        $total_customers = User::where('is_admin', false)->count();
        $total_products = Perfume::count();

        $recent_orders = Order::orderBy('created_at', 'desc')->take(5)->get();
        $low_stock_products = Perfume::where('stock_quantity', '<', 5)->take(10)->get();

        return view('admin.dashboard', compact(
            'total_orders', 
            'total_sales', 
            'total_customers', 
            'total_products', 
            'recent_orders', 
            'low_stock_products'
        ));
    }

    // Orders Management
    public function orders(Request $request)
    {
        $orders = Order::with('user')
            ->when($request->status, function($query, $status) {
                return $query->where('order_status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        $order->load(['items.perfume', 'user']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'order_status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'nullable|in:pending,paid,failed',
        ]);

        $order->update(array_filter($validated));

        return back()->with('success', 'Order state has been synchronized.');
    }

    // Products Management
    public function products()
    {
        $products = Perfume::with(['brand', 'categories'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.create', compact('brands', 'categories'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
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
            'sku' => 'nullable|string|unique:perfumes,sku',
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

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']) . '-' . uniqid();
        
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('products', 'public');
            $validated['featured_image'] = '/storage/' . $path;
        }

        Perfume::create($validated);

        return redirect()->route('admin.products')->with('success', 'Fragrance added to collection.');
    }

    public function editProduct(Perfume $product)
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'brands', 'categories'));
    }

    public function updateProduct(Request $request, Perfume $product)
    {
        $validated = $request->validate([
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
            'sku' => 'nullable|string|unique:perfumes,sku,' . $product->id,
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

        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($product->featured_image && file_exists(public_path($product->featured_image))) {
                // Warning: Just a placeholder for actual deletion logic if using storage
            }
            $path = $request->file('featured_image')->store('products', 'public');
            $validated['featured_image'] = '/storage/' . $path;
        }

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    // Brands Management
    public function brands()
    {
        $brands = Brand::withCount('perfumes')->orderBy('name')->paginate(15);
        return view('admin.brands.index', compact('brands'));
    }

    public function createBrand()
    {
        return view('admin.brands.create');
    }

    public function storeBrand(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'description' => 'nullable|string',
        ]);

        Brand::create($validated);

        return redirect()->route('admin.brands')->with('success', 'Brand added successfully.');
    }

    public function editBrand(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function updateBrand(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'description' => 'nullable|string',
        ]);

        $brand->update($validated);

        return redirect()->route('admin.brands')->with('success', 'Brand updated successfully.');
    }

    public function destroyBrand(Brand $brand)
    {
        if ($brand->perfumes()->count() > 0) {
            return back()->with('error', 'Cannot delete brand with associated products.');
        }
        $brand->delete();
        return redirect()->route('admin.brands')->with('success', 'Brand deleted.');
    }

    public function destroyProduct(Perfume $product)
    {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted.');
    }

    // Customers Management
    public function customers()
    {
        $customers = User::where('is_admin', false)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.customers.index', compact('customers'));
    }

    // Payments Management
    public function payments()
    {
        $payments = Order::where('payment_status', '!=', 'pending')
            ->orderBy('updated_at', 'desc')
            ->paginate(15);
        return view('admin.payments.index', compact('payments'));
    }
}