@extends('layouts.app')

@section('title', $perfume->name . ' | Chic Scents')

@section('content')
    <!-- Top Spacer -->
    <div class="h-11 w-full bg-ivory/90"></div>
    
    <!-- Header -->
    

    <main class="pb-32">
        <!-- Breadcrumb -->
        <div class="px-8 py-6">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center gap-2 text-xs text-slate-400">
                    <a href="{{ route('home') }}" class="hover:text-gold-deep transition">Home</a>
                    <span>/</span>
                    <a href="{{ route('shop.index') }}" class="hover:text-gold-deep transition">Shop</a>
                    <span>/</span>
                    @if($perfume->brand)
                        <a href="{{ route('shop.index', ['brand' => $perfume->brand->slug]) }}" class="hover:text-gold-deep transition">{{ $perfume->brand->name }}</a>
                        <span>/</span>
                    @endif
                    <span class="text-gold-deep">{{ $perfume->name }}</span>
                </div>
            </div>
        </div>

        <!-- Product Main Section -->
        <section class="px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16">
                    
                    <!-- Left Column - Images -->
                    <div>
                        <div class="aspect-[3/4] bg-ivory rounded-sm overflow-hidden shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
                            @if($perfume->featured_image)
                                <img 
                                    src="{{ asset($perfume->featured_image) }}" 
                                    alt="{{ $perfume->name }}"
                                    class="w-full h-full object-cover"
                                />
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-slate-400">No image available</span>
                                </div>
                            @endif
                        </div>

                        <!-- Gallery Images (if any) -->
                        @if($perfume->gallery_images && count($perfume->gallery_images) > 0)
                            <div class="grid grid-cols-4 gap-3 mt-4">
                                @foreach($perfume->gallery_images as $image)
                                    <div class="aspect-square bg-ivory rounded-sm overflow-hidden cursor-pointer hover:opacity-80 transition">
                                        <img src="{{ asset($image) }}" alt="" class="w-full h-full object-cover"/>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Right Column - Product Info -->
                    <div class="py-8">
                        <!-- Brand -->
                        @if($perfume->brand)
                            <p class="text-[11px] uppercase tracking-[0.3em] text-gold-deep mb-3">
                                {{ $perfume->brand->name }}
                            </p>
                        @endif

                        <!-- Title -->
                        <h1 class="text-4xl md:text-5xl serif-heading font-light mb-4">
                            {{ $perfume->name }}
                        </h1>

                        <!-- Short Description -->
                        @if($perfume->short_description)
                            <p class="text-slate-600 leading-relaxed mb-6">
                                {{ $perfume->short_description }}
                            </p>
                        @endif

                        <!-- Rating -->
                        @if($perfume->review_count > 0)
                            <div class="flex items-center gap-4 mb-6">
                                <div class="flex items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= round($perfume->average_rating) ? 'text-gold-deep' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-sm text-slate-500">{{ $perfume->review_count }} reviews</span>
                            </div>
                        @endif

                        <!-- Price Display - Will update based on selection -->
                        <div class="mb-8" id="priceDisplay">
                            @if($perfume->is_on_sale)
                                <div class="flex items-center gap-3">
                                    <span class="text-3xl text-gold-deep font-light">Kshs {{ number_format($perfume->current_price, 2) }}</span>
                                    <span class="text-lg text-slate-400 line-through">Kshs {{ number_format($perfume->price, 2) }}</span>
                                    <span class="bg-red-500 text-white text-xs px-3 py-1 rounded-full">-{{ $perfume->discount_percentage }}%</span>
                                </div>
                            @else
                                <span class="text-3xl text-gold-deep font-light">Kshs {{ number_format($perfume->price, 2) }}</span>
                            @endif
                        </div>

                        <!-- SIZE SELECTION - NEW -->
                        <div class="mb-8">
                            <h3 class="text-sm uppercase tracking-widest text-slate-500 mb-4">Select Size</h3>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Decant Option -->
                                <label class="relative size-option cursor-pointer" data-size="decant" data-price="{{ $perfume->decant_price ?? 0 }}">
                                    <input type="radio" name="product_size" value="decant" class="peer hidden" 
                                           @if(!($perfume->decant_price ?? false)) disabled @endif>
                                    <div class="border-2 border-rose-soft rounded-lg p-4 text-center transition-all peer-checked:border-gold-deep peer-checked:bg-gold-deep/5 hover:border-gold-deep/50 
                                                @if(!($perfume->decant_price ?? false)) opacity-50 cursor-not-allowed @endif">
                                        <span class="block text-sm font-medium mb-1">Decant</span>
                                        <span class="block text-xs text-slate-500 mb-2">10ml</span>
                                        @if($perfume->decant_price)
                                            <span class="block text-lg text-gold-deep font-light">
                                                Kshs {{ number_format($perfume->decant_price, 2) }}
                                            </span>
                                        @else
                                            <span class="block text-sm text-slate-400">Coming Soon</span>
                                        @endif
                                    </div>
                                </label>

                                <!-- Full Bottle Option -->
                                <label class="relative size-option cursor-pointer" data-size="full" data-price="{{ $perfume->price }}">
                                    <input type="radio" name="product_size" value="full" class="peer hidden" checked>
                                    <div class="border-2 border-rose-soft rounded-lg p-4 text-center transition-all peer-checked:border-gold-deep peer-checked:bg-gold-deep/5 hover:border-gold-deep/50">
                                        <span class="block text-sm font-medium mb-1">Full Bottle</span>
                                        <span class="block text-xs text-slate-500 mb-2">100ml</span>
                                        <span class="block text-lg text-gold-deep font-light">
                                            Kshs {{ number_format($perfume->price, 2) }}
                                        </span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Type/Size Info -->
                        <div class="flex flex-wrap gap-4 mb-8">
                            @if($perfume->type)
                                <div class="px-4 py-2 bg-ivory rounded-full text-xs uppercase tracking-wider">
                                    {{ str_replace('_', ' ', $perfume->type) }}
                                </div>
                            @endif
                            @if($perfume->volume)
                                <div class="px-4 py-2 bg-ivory rounded-full text-xs uppercase tracking-wider">
                                    {{ $perfume->volume }}ml
                                </div>
                            @endif
                            @if($perfume->concentration)
                                <div class="px-4 py-2 bg-ivory rounded-full text-xs uppercase tracking-wider">
                                    {{ $perfume->concentration }}
                                </div>
                            @endif
                        </div>

                        <!-- Quantity Selector - NEW -->
                        <div class="mb-8">
                            <h3 class="text-sm uppercase tracking-widest text-slate-500 mb-4">Quantity</h3>
                            <div class="flex items-center border border-rose-soft rounded-full w-fit">
                                <button type="button" class="decrement-btn px-6 py-3 text-slate-500 hover:text-gold-deep transition" onclick="updateQuantity(-1)">−</button>
                                <input type="number" id="quantity" value="1" min="1" max="{{ $perfume->stock_quantity }}" class="w-16 text-center border-0 focus:ring-0 bg-transparent" readonly>
                                <button type="button" class="increment-btn px-6 py-3 text-slate-500 hover:text-gold-deep transition" onclick="updateQuantity(1)">+</button>
                            </div>
                        </div>

                        <!-- Add to Cart Button -->
                        <button 
                            class="w-full bg-gold-deep text-white py-4 rounded-full text-sm tracking-widest uppercase hover:opacity-90 transition mb-6 disabled:opacity-50 disabled:cursor-not-allowed"
                            onclick="addToCart()"
                            @if($perfume->stock_quantity < 1) disabled @endif
                            id="addToCartBtn"
                        >
                            @if($perfume->stock_quantity > 0)
                                Add to Cart
                            @else
                                Out of Stock
                            @endif
                        </button>

                        <!-- Stock Status -->
                        @if($perfume->stock_quantity > 0)
                            <p class="text-sm text-slate-500 text-center">
                                In stock: <span id="stockCount">{{ $perfume->stock_quantity }}</span> available
                            </p>
                        @else
                            <p class="text-sm text-red-500 text-center">
                                Out of stock
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <x-divider />

        <!-- Fragrance Notes Section -->
        @if($perfume->top_notes || $perfume->heart_notes || $perfume->base_notes || $perfume->notes)
        <section class="px-8 mt-16">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-2xl serif-heading font-light text-center mb-12">Fragrance Notes</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @if($perfume->top_notes)
                    <div class="text-center">
                        <span class="text-[10px] uppercase tracking-[0.3em] text-gold-deep mb-3 block">Top Notes</span>
                        <p class="text-slate-700">{{ $perfume->top_notes }}</p>
                    </div>
                    @endif

                    @if($perfume->heart_notes)
                    <div class="text-center">
                        <span class="text-[10px] uppercase tracking-[0.3em] text-gold-deep mb-3 block">Heart Notes</span>
                        <p class="text-slate-700">{{ $perfume->heart_notes }}</p>
                    </div>
                    @endif

                    @if($perfume->base_notes)
                    <div class="text-center">
                        <span class="text-[10px] uppercase tracking-[0.3em] text-gold-deep mb-3 block">Base Notes</span>
                        <p class="text-slate-700">{{ $perfume->base_notes }}</p>
                    </div>
                    @endif
                </div>

                @if($perfume->notes && !$perfume->top_notes && !$perfume->heart_notes && !$perfume->base_notes)
                <div class="text-center">
                    <p class="text-slate-700">{{ $perfume->notes }}</p>
                </div>
                @endif
            </div>
        </section>
        @endif

        <!-- Divider -->
        <x-divider />

        <!-- Full Description -->
        @if($perfume->description)
        <section class="px-8 mt-16">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-2xl serif-heading font-light mb-6">About This Fragrance</h2>
                <p class="text-slate-600 leading-relaxed">{{ $perfume->description }}</p>
            </div>
        </section>
        @endif

        <!-- Divider -->
        <x-divider />

        <!-- Details Grid -->
        <section class="px-8 mt-16">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl serif-heading font-light text-center mb-12">Product Details</h2>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @if($perfume->gender)
                    <div class="text-center">
                        <span class="text-[10px] uppercase tracking-[0.2em] text-gold-deep mb-2 block">Gender</span>
                        <span class="text-sm">{{ $perfume->gender }}</span>
                    </div>
                    @endif

                    @if($perfume->season)
                    <div class="text-center">
                        <span class="text-[10px] uppercase tracking-[0.2em] text-gold-deep mb-2 block">Season</span>
                        <span class="text-sm">{{ $perfume->season }}</span>
                    </div>
                    @endif

                    @if($perfume->occasion)
                    <div class="text-center">
                        <span class="text-[10px] uppercase tracking-[0.2em] text-gold-deep mb-2 block">Occasion</span>
                        <span class="text-sm">{{ $perfume->occasion }}</span>
                    </div>
                    @endif

                    @if($perfume->longevity)
                    <div class="text-center">
                        <span class="text-[10px] uppercase tracking-[0.2em] text-gold-deep mb-2 block">Longevity</span>
                        <span class="text-sm">{{ $perfume->longevity }}</span>
                    </div>
                    @endif

                    @if($perfume->sillage)
                    <div class="text-center">
                        <span class="text-[10px] uppercase tracking-[0.2em] text-gold-deep mb-2 block">Sillage</span>
                        <span class="text-sm">{{ $perfume->sillage }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Newsletter -->
        <x-newsletter />
    </main>

    <!-- Footer -->
    <x-footer-home />
@endsection

@push('scripts')
<script>
let currentQuantity = 1;
const maxStock = {{ $perfume->stock_quantity }};
let decantPrice = {{ $perfume->decant_price ?? 0 }};
let fullPrice = {{ $perfume->price }};

// Initialize with full bottle selected
updatePriceDisplay('full', fullPrice);

// Add event listeners to size options
document.querySelectorAll('.size-option').forEach(option => {
    option.addEventListener('click', function() {
        const radio = this.querySelector('input[type="radio"]');
        if (!radio.disabled) {
            radio.checked = true;
            const size = this.dataset.size;
            const price = parseFloat(this.dataset.price);
            updatePriceDisplay(size, price);
        }
    });
});

function updateQuantity(change) {
    const newQuantity = currentQuantity + change;
    if (newQuantity >= 1 && newQuantity <= maxStock) {
        currentQuantity = newQuantity;
        document.getElementById('quantity').value = currentQuantity;
    }
}

function updatePriceDisplay(size, price) {
    const priceDisplay = document.getElementById('priceDisplay');
    const formattedPrice = 'Kshs ' + price.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    
    // Check if product is on sale (for full bottle only)
    @if($perfume->is_on_sale)
    if (size === 'full') {
        priceDisplay.innerHTML = `
            <div class="flex items-center gap-3">
                <span class="text-3xl text-gold-deep font-light">${formattedPrice}</span>
                <span class="text-lg text-slate-400 line-through">Kshs {{ number_format($perfume->price, 2) }}</span>
                <span class="bg-red-500 text-white text-xs px-3 py-1 rounded-full">-{{ $perfume->discount_percentage }}%</span>
            </div>
        `;
    } else {
        priceDisplay.innerHTML = `<span class="text-3xl text-gold-deep font-light">${formattedPrice}</span>`;
    }
    @else
    priceDisplay.innerHTML = `<span class="text-3xl text-gold-deep font-light">${formattedPrice}</span>`;
    @endif
}

function getSelectedSize() {
    const selectedRadio = document.querySelector('input[name="product_size"]:checked');
    return selectedRadio ? selectedRadio.value : 'full';
}

function getSelectedPrice() {
    const size = getSelectedSize();
    if (size === 'decant') {
        return decantPrice;
    } else {
        return fullPrice;
    }
}

function addToCart() {
    const size = getSelectedSize();
    const price = getSelectedPrice();
    
    // Check if decant is selected but no price set
    if (size === 'decant' && decantPrice === 0) {
        showNotification('Decant not available for this product', 'error');
        return;
    }
    
    // Show loading state
    const btn = document.getElementById('addToCartBtn');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<span class="material-symbols-outlined animate-spin text-lg">progress_activity</span> Adding...';
    btn.disabled = true;

    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            product_id: {{ $perfume->id }},
            size: size,
            quantity: currentQuantity,
            price: price
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update cart count in header
            updateCartCount(data.cart_count);
            
            // Show success message
            showNotification('Added to cart!', 'success');
        } else {
            showNotification(data.message || 'Error adding to cart', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error adding to cart', 'error');
    })
    .finally(() => {
        // Restore button
        btn.innerHTML = originalText;
        btn.disabled = false;
    });
}

function updateCartCount(count) {
    const cartBadge = document.querySelector('a[href="/cart"] .absolute');
    if (cartBadge) {
        cartBadge.textContent = count;
    }
}

function showNotification(message, type = 'success') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-24 right-4 z-50 px-6 py-3 rounded-full text-sm ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    } shadow-lg transform transition-transform duration-300 translate-x-full`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 10);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}
</script>
@endpush