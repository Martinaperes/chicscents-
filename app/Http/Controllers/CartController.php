<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $subtotal = 0;
        
        foreach ($cart as &$item) {
            $item['total'] = $item['price'] * $item['quantity'];
            $subtotal += $item['total'];
        }
        
        return view('cart.index', [
            'cart' => $cart,
            'subtotal' => $subtotal
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'size' => 'required|in:decant,full',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric'
        ]);

        $cart = Session::get('cart', []);
        
        // Get product details from database
        $product = \App\Models\Perfume::with('brand')->find($request->product_id);
        
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }

        // Create unique ID for cart item (combination of product ID and size)
        $itemId = $product->id . '_' . $request->size;
        
        if (isset($cart[$itemId])) {
            // Update quantity if item exists
            $cart[$itemId]['quantity'] += $request->quantity;
        } else {
            // Add new item
            $cart[$itemId] = [
                'id' => $itemId,
                'product_id' => $product->id,
                'name' => $product->name,
                'brand' => $product->brand->name ?? '',
                'slug' => $product->slug,
                'image' => $product->featured_image,
                'size' => $request->size,
                'price' => $request->price,
                'quantity' => $request->quantity
            ];
        }

        Session::put('cart', $cart);
        
        // Calculate total cart count
        $cartCount = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'success' => true,
            'cart_count' => $cartCount,
            'message' => 'Added to cart successfully'
        ]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'item_id' => 'required|string'
        ]);

        $cart = Session::get('cart', []);
        
        if (isset($cart[$request->item_id])) {
            unset($cart[$request->item_id]);
            Session::put('cart', $cart);
        }

        $subtotal = $this->calculateSubtotal($cart);
        $cartCount = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'success' => true,
            'cart_count' => $cartCount,
            'subtotal' => number_format($subtotal, 2)
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'item_id' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Session::get('cart', []);
        
        if (isset($cart[$request->item_id])) {
            $cart[$request->item_id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
            
            $itemTotal = $cart[$request->item_id]['price'] * $request->quantity;
            $subtotal = $this->calculateSubtotal($cart);
            $cartCount = array_sum(array_column($cart, 'quantity'));

            return response()->json([
                'success' => true,
                'item_total' => number_format($itemTotal, 2),
                'subtotal' => number_format($subtotal, 2),
                'cart_count' => $cartCount
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Item not found'
        ]);
    }

    private function calculateSubtotal($cart)
    {
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        return $subtotal;
    }
    public function addToCart(Request $request)
{
    $cart = json_decode(Cookie::get('cart', '[]'), true);
    
    $cart[] = [
        'product_id' => $request->product_id,
        'size' => $request->size,
        'quantity' => $request->quantity,
        'price' => $request->price,
        'added_at' => now()->toDateTimeString()
    ];
    
    Cookie::queue('cart', json_encode($cart), 4320); // 3 days
    
    return response()->json([
        'success' => true,
        'cart_count' => count($cart)
    ]);
}
}