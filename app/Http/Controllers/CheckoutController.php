<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Perfume;

class CheckoutController extends Controller
{
    /**
     * YOUR WhatsApp number (international format, no + or spaces).
     * Change this to your actual WhatsApp number.
     */
    const SELLER_WHATSAPP = '254716052342';

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

        return view('checkout.index', compact('cartItems', 'subtotal'));
    }

    /**
     * Process checkout – build WhatsApp message and redirect to success page
     */
    public function process(Request $request)
    {
        $validated = $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string|max:255',
            'city'           => 'required|string|max:255',
            'county'         => 'required|string|max:255',
            'payment_method' => 'required|in:mpesa,cash',
            'notes'          => 'nullable|string|max:1000',
        ]);

        // Get cart
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty');
        }

        // Build cart items & subtotal
        $cartItems = [];
        $subtotal  = 0;

        foreach ($cart as $item) {
            $product = Perfume::find($item['product_id']);
            if ($product) {
                $price     = $item['price'];
                $itemTotal = $price * $item['quantity'];
                $subtotal += $itemTotal;

                $cartItems[] = [
                    'name'     => $product->name,
                    'brand'    => optional($product->brand)->name ?? '',
                    'size'     => ucfirst($item['size']),
                    'quantity' => $item['quantity'],
                    'price'    => $price,
                    'total'    => $itemTotal,
                ];
            }
        }

        // Generate a simple order reference
        $orderRef = 'SC-' . strtoupper(substr(md5(uniqid()), 0, 6));

        // ── Build WhatsApp message ──────────────────────────────────────────────
        $lines = [];
        $lines[] = "🛍️ *NEW ORDER – ScentCepts*";
        $lines[] = "Order Ref: *{$orderRef}*";
        $lines[] = "─────────────────────";
        $lines[] = "";
        $lines[] = "👤 *Customer Details*";
        $lines[] = "Name: {$validated['first_name']} {$validated['last_name']}";
        $lines[] = "Phone: {$validated['phone']}";
        $lines[] = "Email: {$validated['email']}";
        $lines[] = "";
        $lines[] = "📍 *Delivery Location*";
        $lines[] = "Address: {$validated['address']}";
        $lines[] = "City: {$validated['city']}";
        $lines[] = "County: {$validated['county']}";
        $lines[] = "";
        $lines[] = "🧴 *Order Items*";

        foreach ($cartItems as $index => $item) {
            $num = $index + 1;
            $brand = $item['brand'] ? "{$item['brand']} – " : '';
            $lines[] = "{$num}. {$brand}{$item['name']}";
            $lines[] = "   Size: {$item['size']} | Qty: {$item['quantity']} | Ksh " . number_format($item['total']);
        }

        $lines[] = "";
        $lines[] = "─────────────────────";
        $lines[] = "🧾 *Products Total: Ksh " . number_format($subtotal) . "*";
        $lines[] = "💳 Payment: M-PESA";
        $lines[] = "🚚 Delivery fee: TBD (please confirm)";

        if (!empty($validated['notes'])) {
            $lines[] = "";
            $lines[] = "📝 *Notes:* {$validated['notes']}";
        }

        $lines[] = "";
        $lines[] = "_Sent from ScentCepts website_";

        $whatsappText    = implode("\n", $lines);
        $whatsappUrl     = 'https://wa.me/' . self::SELLER_WHATSAPP . '?text=' . rawurlencode($whatsappText);

        // Store order summary in session for the success page
        Session::put('order_summary', [
            'ref'        => $orderRef,
            'customer'   => $validated['first_name'] . ' ' . $validated['last_name'],
            'phone'      => $validated['phone'],
            'email'      => $validated['email'],
            'address'    => $validated['address'],
            'city'       => $validated['city'],
            'county'     => $validated['county'],
            'items'      => $cartItems,
            'subtotal'   => $subtotal,
            'notes'      => $validated['notes'] ?? null,
            'whatsapp_url' => $whatsappUrl,
        ]);

        // Clear the cart
        Session::forget('cart');

        return redirect()->route('checkout.success');
    }

    /**
     * Show order success / WhatsApp confirmation page
     */
    public function success()
    {
        $order = Session::get('order_summary');

        // If they landed here directly with no order, redirect home
        if (!$order) {
            return redirect()->route('home');
        }

        return view('checkout.success', compact('order'));
    }
}