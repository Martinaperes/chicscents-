<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Perfume;

class CheckoutController extends Controller
{
    /**
     * Display checkout page
     */
    public function index(Request $request)
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $cartItems = [];
        $subtotal  = 0;

        foreach ($cart as $item) {
            $product = Perfume::with('brand')->find($item['product_id']);
            if ($product) {
                $price     = $item['price'];
                $itemTotal = $price * $item['quantity'];
                $subtotal += $itemTotal;

                $cartItems[] = [
                    'product'  => $product,
                    'size'     => $item['size'],
                    'quantity' => $item['quantity'],
                    'price'    => $price,
                    'total'    => $itemTotal,
                ];
            }
        }

        // Default shipping: CBD flat fee
        $shipping = 100;
        $total    = $subtotal + $shipping;

        return view('checkout.index', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    /**
     * Process checkout form submission
     */
    public function process(Request $request)
    {
        $validated = $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone'            => 'required|string|max:20',
            'address'          => 'required|string|max:255',
            'delivery_zone'    => 'required|in:cbd,mtaani',
            'payment_method'   => 'required|in:mpesa,cash',
            'notes'            => 'nullable|string|max:500',

            // CBD-specific (present when zone = cbd)
            'city'             => 'required_if:delivery_zone,cbd|nullable|string|max:255',
            'county'           => 'required_if:delivery_zone,cbd|nullable|string|max:255',

            // Mtaani-specific (present when zone = mtaani)
            'mtaani_location'  => 'required_if:delivery_zone,mtaani|nullable|string|max:255',
            'city_mtaani'      => 'required_if:delivery_zone,mtaani|nullable|string|max:255',
            'county_mtaani'    => 'required_if:delivery_zone,mtaani|nullable|string|max:255',
            'pickup_location'  => 'required_if:delivery_zone,mtaani|nullable|string|max:255',
            'shipping_fee'     => 'required|numeric|min:0',
        ]);

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty');
        }

        // Determine delivery details
        $deliveryZone    = $validated['delivery_zone'];
        $shippingFee     = (float) $validated['shipping_fee'];
        $pickupLocation  = null;
        $deliveryMethod  = 'doorstep';
        $city            = $validated['city'] ?? 'Nairobi';
        $county          = $validated['county'] ?? 'Nairobi';

        if ($deliveryZone === 'cbd') {
            $shippingFee    = 100; // enforce flat CBD fee server-side
            $deliveryMethod = 'doorstep';
            $city           = 'Nairobi';
            $county         = 'Nairobi';
        } else {
            // Pickup Mtaani
            $deliveryMethod = 'pickup';
            $city           = $validated['city_mtaani'] ?? '';
            $county         = $validated['county_mtaani'] ?? '';
            $pickupLocation = $validated['pickup_location'] ?? null;
            // shippingFee comes from the hidden input (set by JS from agent data-fee)
            // Enforce a minimum to prevent tampering
            if ($shippingFee < 100) {
                $shippingFee = 100;
            }
        }

        // Calculate cart subtotal
        $subtotal = 0;
        foreach ($cart as $item) {
            $product = Perfume::find($item['product_id']);
            if ($product) {
                $subtotal += $item['price'] * $item['quantity'];
            }
        }

        $totalAmount = $subtotal + $shippingFee;

        // --- Order creation (extend as needed) ---
        // \App\Models\Order::create([
        //     'first_name'      => $validated['first_name'],
        //     'last_name'       => $validated['last_name'],
        //     'email'           => $validated['email'],
        //     'phone'           => $validated['phone'],
        //     'address'         => $validated['address'],
        //     'city'            => $city,
        //     'county'          => $county,
        //     'delivery_method' => $deliveryMethod,
        //     'pickup_location' => $pickupLocation,
        //     'payment_method'  => $validated['payment_method'],
        //     'payment_status'  => 'pending',
        //     'order_status'    => 'pending',
        //     'shipping_amount' => $shippingFee,
        //     'total_amount'    => $totalAmount,
        //     'notes'           => $validated['notes'] ?? null,
        // ]);

        Session::forget('cart');

        return redirect()->route('checkout.success')
                         ->with('success', 'Order placed successfully! You will receive a confirmation shortly.');
    }

    /**
     * Show order success page
     */
    public function success()
    {
        return view('checkout.success');
    }
}