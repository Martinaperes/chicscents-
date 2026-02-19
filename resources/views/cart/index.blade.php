@extends('layouts.app')

@section('title', 'Shopping Cart | Chic Scents')

@section('content')
<div class="min-h-screen bg-ivory">
    <!-- Top Spacer -->
    <div class="h-11 w-full bg-ivory/90 sticky top-0 z-50 backdrop-blur-md"></div>

    <main class="pb-32">
        <!-- Header -->
        <div class="px-8 py-12">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-4xl md:text-5xl serif-heading font-light text-center">Shopping Cart</h1>
                
                <!-- Breadcrumb -->
                <div class="flex items-center justify-center gap-2 text-xs text-slate-400 mt-4">
                    <a href="{{ route('home') }}" class="hover:text-gold-deep transition">Home</a>
                    <span>/</span>
                    <span class="text-gold-deep">Cart</span>
                </div>
            </div>
        </div>

        <!-- Cart Content -->
        <div class="px-8">
            <div class="max-w-7xl mx-auto">
                @if(isset($cart) && count($cart) > 0)
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                        <!-- Cart Items -->
                        <div class="lg:col-span-2">
                            <div class="space-y-6">
                                @foreach($cart as $item)
                                <div class="flex gap-6 p-6 bg-white rounded-sm shadow-sm" data-cart-item="{{ $item['id'] }}">
                                    <!-- Product Image -->
                                    <div class="w-24 h-24 bg-ivory rounded-sm overflow-hidden flex-shrink-0">
                                        @if($item['image'])
                                            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <span class="text-slate-400 text-xs">No image</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Product Details -->
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <div>
                                                <h3 class="font-medium hover:text-gold-deep transition">
                                                    <a href="{{ route('products.show', $item['slug']) }}">{{ $item['name'] }}</a>
                                                </h3>
                                                <p class="text-xs text-slate-500 mt-1">{{ $item['brand'] }}</p>
                                                <p class="text-xs text-gold-deep mt-2">{{ ucfirst($item['size']) }} Size</p>
                                            </div>
                                            <button onclick="removeFromCart('{{ $item['id'] }}')" class="text-slate-400 hover:text-red-500 transition">
                                                <span class="material-symbols-outlined">close</span>
                                            </button>
                                        </div>

                                        <div class="flex justify-between items-end mt-4">
                                            <div class="flex items-center border border-rose-soft rounded-full">
                                                <button type="button" class="px-4 py-1 text-slate-500 hover:text-gold-deep transition" onclick="updateCartItemQuantity('{{ $item['id'] }}', -1)">−</button>
                                                <span class="w-12 text-center quantity-display">{{ $item['quantity'] }}</span>
                                                <button type="button" class="px-4 py-1 text-slate-500 hover:text-gold-deep transition" onclick="updateCartItemQuantity('{{ $item['id'] }}', 1)">+</button>
                                            </div>
                                            <span class="text-gold-deep font-light">Kshs {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Continue Shopping -->
                            <div class="mt-8">
                                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-gold-deep transition">
                                    <span class="material-symbols-outlined text-lg">arrow_back</span>
                                    Continue Shopping
                                </a>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="lg:col-span-1">
                            <div class="bg-white rounded-sm shadow-sm p-6 sticky top-32">
                                <h2 class="text-lg font-medium mb-6">Order Summary</h2>
                                
                                <div class="space-y-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-500">Subtotal</span>
                                        <span class="font-medium" id="subtotal">Kshs {{ number_format($subtotal, 2) }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-500">Shipping</span>
                                        <span class="font-medium">Calculated at checkout</span>
                                    </div>
                                    
                                    <div class="border-t border-rose-soft pt-4">
                                        <div class="flex justify-between">
                                            <span class="font-medium">Total</span>
                                            <span class="text-xl text-gold-deep font-light" id="total">Kshs {{ number_format($subtotal, 2) }}</span>
                                        </div>
                                        <p class="text-xs text-slate-400 mt-1">Inclusive of all taxes</p>
                                    </div>

                                   <a href="{{ route('checkout.index') }}" class="block w-full">
    <button class="w-full bg-gold-deep text-white py-4 rounded-full text-sm tracking-widest uppercase hover:opacity-90 transition mt-6">
        Proceed to Checkout
    </button>
</a>

                                    <!-- Payment Icons -->
                                    <div class="flex justify-center gap-3 mt-4">
                                        <span class="text-xs text-slate-400">We accept:</span>
                                        <span class="text-xs text-slate-500">M-Pesa</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Empty Cart -->
                    <div class="text-center py-16">
                        <span class="material-symbols-outlined text-6xl text-slate-300 mb-4">shopping_bag</span>
                        <h2 class="text-2xl serif-heading font-light mb-4">Your cart is empty</h2>
                        <p class="text-slate-500 mb-8">Looks like you haven't added any fragrances to your cart yet.</p>
                        <a href="{{ route('products.index') }}" class="inline-block bg-gold-deep text-white px-8 py-4 rounded-full text-sm tracking-widest uppercase hover:opacity-90 transition">
                            Start Shopping
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
function removeFromCart(itemId) {
    if (!confirm('Remove this item from your cart?')) return;
    
    fetch('{{ route("cart.remove") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ item_id: itemId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove item from DOM
            document.querySelector(`[data-cart-item="${itemId}"]`).remove();
            
            // Update cart count
            updateCartCount(data.cart_count);
            
            // Update totals
            document.getElementById('subtotal').textContent = 'Kshs ' + data.subtotal;
            document.getElementById('total').textContent = 'Kshs ' + data.subtotal;
            
            // Reload if cart is empty
            if (data.cart_count === 0) {
                location.reload();
            }
            
            showNotification('Item removed from cart', 'success');
        }
    });
}

function updateCartItemQuantity(itemId, change) {
    const item = document.querySelector(`[data-cart-item="${itemId}"]`);
    const quantitySpan = item.querySelector('.quantity-display');
    const currentQuantity = parseInt(quantitySpan.textContent);
    const newQuantity = currentQuantity + change;
    
    if (newQuantity < 1) return;
    
    fetch('{{ route("cart.update") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            item_id: itemId,
            quantity: newQuantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            quantitySpan.textContent = newQuantity;
            
            // Update item price
            const priceSpan = item.querySelector('.text-gold-deep');
            priceSpan.textContent = 'Kshs ' + data.item_total;
            
            // Update totals
            document.getElementById('subtotal').textContent = 'Kshs ' + data.subtotal;
            document.getElementById('total').textContent = 'Kshs ' + data.subtotal;
            
            // Update cart count
            updateCartCount(data.cart_count);
        }
    });
}

function updateCartCount(count) {
    const cartBadge = document.querySelector('a[href="/cart"] .absolute');
    if (cartBadge) {
        cartBadge.textContent = count;
    }
}

function showNotification(message, type = 'success') {
    // Same notification function as in product page
    const notification = document.createElement('div');
    notification.className = `fixed top-24 right-4 z-50 px-6 py-3 rounded-full text-sm ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    } shadow-lg transform transition-transform duration-300 translate-x-full`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 10);
    
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}
</script>
@endpush