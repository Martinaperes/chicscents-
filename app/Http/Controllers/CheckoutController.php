<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;

class CheckoutController extends Controller
{
    /**
     * Display checkout page
     */
    public function index(Request $request)
    {
        // Get cart from cookie
        $cart = json_decode(Cookie::get('cart', '[]'), true);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }
        
        // Get product details for items in cart
        $cartItems = [];
        $subtotal = 0;
        
        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                $price = $item['size'] === 'decant' ? 
                        ($product->decant_price ?? $product->price * 0.3) : 
                        $product->current_price;
                
                $itemTotal = $price * $item['quantity'];
                $subtotal += $itemTotal;
                
                $cartItems[] = [
                    'product' => $product,
                    'size' => $item['size'],
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'total' => $itemTotal
                ];
            }
        }
        
        // Calculate totals
        $shipping = $subtotal > 5000 ? 0 : 250; // Free shipping over Kshs 5000
        $total = $subtotal + $shipping;
        
        return view('checkout.index', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }
    
    /**
     * Process checkout form submission
     */
    public function process(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'county' => 'required|string|max:255',
            'delivery_method' => 'required|in:doorstep,pickup',
            'pickup_location' => 'required_if:delivery_method,pickup|nullable|string|max:255',
            'payment_method' => 'required|in:mpesa,cash',
            'notes' => 'nullable|string|max:500'
        ]);
        
        // Get cart from cookie
        $cart = json_decode(Cookie::get('cart', '[]'), true);
        
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty');
        }
        
        // Here you would:
        // 1. Create order in database
        // 2. Process payment (if M-Pesa)
        // 3. Clear cart cookie
        // 4. Send confirmation SMS/email
        
        // For now, we'll just clear cart and redirect to success
        Cookie::queue(Cookie::forget('cart'));
        
        return redirect()->route('checkout.success')
                        ->with('success', 'Order placed successfully!');
    }
    
    /**
     * Show order success page
     */
    public function success()
    {
        return view('checkout.success');
    }
}