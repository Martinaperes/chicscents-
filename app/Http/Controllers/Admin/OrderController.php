<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders with filters.
     */
    public function index(Request $request)
    {
        $orders = Order::with(['user', 'items' => function($query) {
                // Optimization: Pre-count items if needed or just eager load
            }])
            ->when($request->status, function($query, $status) {
                return $query->where('order_status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        // Eager load items and products to prevent database overhead
        $order->load(['items.perfume', 'user']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the order status and payment status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'order_status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'nullable|in:pending,paid,failed',
        ]);

        $order->update(array_filter($validated));

        return back()->with('success', 'Order state has been synchronized.');
    }
}
