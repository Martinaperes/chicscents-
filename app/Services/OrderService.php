<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Perfume;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    /**
     * Create a new order and associated items.
     */
    public function createOrder(array $validated, array $cartData)
    {
        return DB::transaction(function () use ($validated, $cartData) {
            Log::info('Initiating order creation for: ' . $validated['email']);

            // 1. Create the main Order
            $order = Order::create([
                'user_id'         => Auth::id(),
                'first_name'      => $validated['first_name'],
                'last_name'       => $validated['last_name'],
                'email'           => $validated['email'],
                'phone'           => $validated['phone'],
                'address'         => $validated['address'],
                'city'            => $validated['city'],
                'county'          => $validated['county'],
                'delivery_zone'   => 'cbd', // Default placeholder
                'delivery_method' => 'doorstep', // Default placeholder
                'payment_method'  => $validated['payment_method'],
                'total_amount'    => $cartData['subtotal'],
                'order_status'    => 'pending',
                'payment_status'  => 'pending',
                'notes'           => $validated['notes'] ?? null,
            ]);

            Log::info('Order record created Header ID: ' . $order->id);

            // 2. Create Order Items
            foreach ($cartData['items'] as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'perfume_id' => $item['product_id'],
                    'size'       => $item['size'],
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);

                // Update Stock
                $product = Perfume::find($item['product_id']);
                if ($product) {
                    $product->decrement('stock_quantity', $item['quantity']);
                }
            }

            Log::info('Transaction successful for order: ' . $order->id);

            return $order;
        });
    }

    /**
     * Build the WhatsApp message payload for an order.
     */
    public function generateWhatsAppMessage(Order $order)
    {
        $order->load('items.perfume');
        
        $message = "*ScentCepts Order Notification*\n\n";
        $message .= "Order ID: #REF-" . str_pad($order->id, 5, '0', STR_PAD_LEFT) . "\n";
        $message .= "Client: " . $order->first_name . " " . $order->last_name . "\n";
        $message .= "--------------------------\n";
        
        foreach ($order->items as $item) {
            $message .= "• " . $item->perfume->name . " (" . ucfirst($item->size) . ") x" . $item->quantity . " @ Ksh " . number_format($item->price, 2) . "\n";
        }
        
        $message .= "--------------------------\n";
        $message .= "*Grand Total: Ksh " . number_format($order->total_amount, 2) . "*\n\n";
        $message .= "Delivery Location: " . $order->address . ", " . $order->city . "\n";
        $message .= "Payment: " . strtoupper($order->payment_method) . "\n\n";
        $message .= "Please confirm availability and sharing payment details.";

        return $message;
    }
}
