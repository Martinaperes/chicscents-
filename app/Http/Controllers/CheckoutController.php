<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Perfume;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

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
     * Process checkout – save to DB, build WhatsApp message and redirect to success page
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

        // Build cart items details for saving and WhatsApp
        $dbItems = [];
        $subtotal = 0;

        foreach ($cart as $item) {
            $product = Perfume::find($item['product_id']);
            if ($product) {
                $price = $item['price'];
                $itemTotal = $price * $item['quantity'];
                $subtotal += $itemTotal;

                $dbItems[] = [
                    'perfume_id' => $product->id,
                    'name' => $product->name,
                    'brand' => optional($product->brand)->name ?? '',
                    'size' => ucfirst($item['size']),
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'total' => $itemTotal,
                ];
            }
        }

        // Generate an order reference (we'll also use order ID)
        $orderRef = 'SC-' . strtoupper(substr(md5(uniqid()), 0, 6));

        try {
            DB::beginTransaction();

            // 1. Save Order to Database
            $order = Order::create([
                'user_id'         => Auth::id(),
                'first_name'      => $validated['first_name'],
                'last_name'       => $validated['last_name'],
                'email'           => $validated['email'],
                'phone'           => $validated['phone'],
                'address'         => $validated['address'],
                'city'            => $validated['city'],
                'county'          => $validated['county'],
                'delivery_zone'   => $request->input('delivery_zone', 'cbd'),
                'delivery_method' => $request->input('delivery_method', 'doorstep'),
                'mtaani_location' => $request->input('mtaani_location'),
                'pickup_location' => $request->input('pickup_location'),
                'payment_method'  => $validated['payment_method'],
                'payment_status'  => 'pending',
                'order_status'    => 'pending',
                'total_amount'    => $subtotal,
                'shipping_amount' => 0, // Confirmed on WhatsApp
                'notes'           => $validated['notes'],
            ]);

            // 2. Save Order Items
            foreach ($dbItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'perfume_id' => $item['perfume_id'],
                    'size'       => $item['size'],
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);
            }

            DB::commit();

            // ── Build WhatsApp message ──────────────────────────────────────────────
            $lines = [];
            $lines[] = "🛍️ *NEW ORDER – ScentCepts*";
            $lines[] = "Order Ref: *#{$order->id} ({$orderRef})*";
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

            foreach ($dbItems as $index => $item) {
                $num = $index + 1;
                $brandStr = $item['brand'] ? "{$item['brand']} – " : '';
                $lines[] = "{$num}. {$brandStr}{$item['name']}";
                $lines[] = "   Size: {$item['size']} | Qty: {$item['quantity']} | Ksh " . number_format($item['total']);
            }

            $lines[] = "";
            $lines[] = "─────────────────────";
            $lines[] = "🧾 *Products Total: Ksh " . number_format($subtotal) . "*";
            $lines[] = "💳 Payment: " . strtoupper($validated['payment_method']);
            $lines[] = "🚚 Delivery fee: TBD (please confirm)";

            if (!empty($validated['notes'])) {
                $lines[] = "";
                $lines[] = "📝 *Notes:* {$validated['notes']}";
            }

            $lines[] = "";
            $lines[] = "_Sent from ScentCepts website_";

            $whatsappText = implode("\n", $lines);
            $whatsappUrl = 'https://wa.me/' . self::SELLER_WHATSAPP . '?text=' . rawurlencode($whatsappText);

            // Store summary in session for success page
            Session::put('order_summary', [
                'id'           => $order->id,
                'ref'          => $orderRef,
                'customer'     => $validated['first_name'] . ' ' . $validated['last_name'],
                'phone'        => $validated['phone'],
                'email'        => $validated['email'],
                'address'      => $validated['address'],
                'city'         => $validated['city'],
                'county'       => $validated['county'],
                'items'        => $dbItems,
                'subtotal'     => $subtotal,
                'notes'        => $validated['notes'],
                'whatsapp_url' => $whatsappUrl,
            ]);

            // Clear the cart
            Session::forget('cart');

            return redirect()->route('checkout.success');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong while processing your order: ' . $e->getMessage());
        }
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