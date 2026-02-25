<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Perfume;
use App\Services\OrderService;

class CheckoutController extends Controller
{
    /**
     * YOUR WhatsApp number (international format, no + or spaces).
     */
    const SELLER_WHATSAPP = '254716052342';

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display checkout page
     */
    public function index()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $cartData = $this->prepareCartData($cart);

        return view('checkout.index', [
            'cartItems' => $cartData['items'],
            'subtotal'  => $cartData['subtotal']
        ]);
    }

    /**
     * Process checkout – save to DB via OrderService, build WhatsApp message and redirect to success page
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

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty');
        }

        $cartData = $this->prepareCartData($cart);

        try {
            // Modularized creation logic
            $order = $this->orderService->createOrder($validated, $cartData);

            // Generate localized WhatsApp URL
            $whatsappText = $this->orderService->generateWhatsAppMessage($order);
            $whatsappUrl = 'https://wa.me/' . self::SELLER_WHATSAPP . '?text=' . rawurlencode($whatsappText);

            // Store summary in session for success page
            Session::put('order_summary', array_merge($validated, [
                'id'           => $order->id,
                'items'        => $cartData['items'],
                'subtotal'     => $cartData['subtotal'],
                'whatsapp_url' => $whatsappUrl,
            ]));

            Session::forget('cart');

            return redirect()->route('checkout.success');

        } catch (\Exception $e) {
            Log::error('Modular Checkout Error: ' . $e->getMessage());
            return back()->with('error', 'Transaction failed: ' . $e->getMessage());
        }
    }

    /**
     * Show order success page
     */
    public function success()
    {
        $order = Session::get('order_summary');

        if (!$order) {
            return redirect()->route('home');
        }

        return view('checkout.success', compact('order'));
    }

    /**
     * Helper to structure cart data for service and view.
     */
    protected function prepareCartData(array $cart)
    {
        $items = [];
        $subtotal = 0;

        foreach ($cart as $item) {
            $product = Perfume::with('brand')->find($item['product_id']);
            if ($product) {
                $price = $item['price'];
                $itemTotal = $price * $item['quantity'];
                $subtotal += $itemTotal;

                $items[] = [
                    'product_id' => $product->id,
                    'product'    => $product,
                    'name'       => $product->name,
                    'brand'      => optional($product->brand)->name,
                    'size'       => $item['size'],
                    'quantity'   => $item['quantity'],
                    'price'      => $price,
                    'total'      => $itemTotal,
                ];
            }
        }

        return [
            'items'    => $items,
            'subtotal' => $subtotal
        ];
    }
}