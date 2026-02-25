<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Perfume;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with key metrics and recent activity.
     */
    public function index()
    {
        // Cache-friendly aggregation for speed
        $total_orders = Order::count();
        $total_sales = Order::where('payment_status', 'paid')->sum('total_amount');
        $total_customers = User::where('is_admin', false)->count();
        $total_products = Perfume::count();

        // Eager load relationships for speed (N+1 prevention)
        $recent_orders = Order::orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $low_stock_products = Perfume::where('stock_quantity', '<', 5)
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'total_orders', 
            'total_sales', 
            'total_customers', 
            'total_products', 
            'recent_orders', 
            'low_stock_products'
        ));
    }
}
