@extends('layouts.app')

@section('title', 'Checkout | Chic Scents')

@section('content')
<main class="pb-16 md:pb-32">
    <!-- Hero Section -->
    <section class="relative h-[20vh] md:h-[25vh] min-h-[150px] overflow-hidden">
        <img 
            src="https://images.unsplash.com/photo-1607344645866-009c320b63e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
            alt="Checkout"
            class="absolute inset-0 w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="absolute inset-0 flex items-center justify-center text-center text-white px-4">
            <div>
                <span class="text-[10px] md:text-[11px] uppercase tracking-[0.3em] md:tracking-[0.5em] font-medium text-gold-deep mb-2 md:mb-3 block">
                    Secure Checkout
                </span>
                <h1 class="text-2xl md:text-4xl lg:text-5xl serif-heading font-light">
                    Complete Your <span class="italic text-gold-deep">Order</span>
                </h1>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <x-divider />

    <!-- Checkout Content -->
    <section class="py-8 md:py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-sm text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
                <!-- Left Column - Checkout Form -->
                <div class="lg:col-span-2">
                    <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
                        @csrf
                        
                        <!-- Contact Information -->
                        <div class="bg-white rounded-sm shadow-[0_5px_20px_rgba(0,0,0,0.02)] p-6 mb-6">
                            <h2 class="text-lg font-medium mb-4 flex items-center gap-2">
                                <span class="w-6 h-6 bg-gold-deep/10 rounded-full flex items-center justify-center text-xs text-gold-deep">1</span>
                                Contact Information
                            </h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs uppercase tracking-wider text-slate-500 mb-2">First Name *</label>
                                    <input type="text" name="first_name" required 
                                           class="w-full border border-rose-soft rounded-sm px-4 py-3 text-sm focus:border-gold-deep focus:ring-1 focus:ring-gold-deep outline-none transition"
                                           value="{{ old('first_name') }}">
                                    @error('first_name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-xs uppercase tracking-wider text-slate-500 mb-2">Last Name *</label>
                                    <input type="text" name="last_name" required 
                                           class="w-full border border-rose-soft rounded-sm px-4 py-3 text-sm focus:border-gold-deep focus:ring-1 focus:ring-gold-deep outline-none transition"
                                           value="{{ old('last_name') }}">
                                    @error('last_name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-xs uppercase tracking-wider text-slate-500 mb-2">Email *</label>
                                    <input type="email" name="email" required 
                                           class="w-full border border-rose-soft rounded-sm px-4 py-3 text-sm focus:border-gold-deep focus:ring-1 focus:ring-gold-deep outline-none transition"
                                           value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-xs uppercase tracking-wider text-slate-500 mb-2">Phone Number *</label>
                                    <input type="tel" name="phone" required 
                                           class="w-full border border-rose-soft rounded-sm px-4 py-3 text-sm focus:border-gold-deep focus:ring-1 focus:ring-gold-deep outline-none transition"
                                           placeholder="07XX XXX XXX"
                                           value="{{ old('phone') }}">
                                    @error('phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Delivery Information -->
                        <div class="bg-white rounded-sm shadow-[0_5px_20px_rgba(0,0,0,0.02)] p-6 mb-6">
                            <h2 class="text-lg font-medium mb-4 flex items-center gap-2">
                                <span class="w-6 h-6 bg-gold-deep/10 rounded-full flex items-center justify-center text-xs text-gold-deep">2</span>
                                Delivery Information
                            </h2>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs uppercase tracking-wider text-slate-500 mb-2">Delivery Address *</label>
                                    <input type="text" name="address" required 
                                           class="w-full border border-rose-soft rounded-sm px-4 py-3 text-sm focus:border-gold-deep focus:ring-1 focus:ring-gold-deep outline-none transition"
                                           placeholder="Street address, building, estate"
                                           value="{{ old('address') }}">
                                    @error('address')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs uppercase tracking-wider text-slate-500 mb-2">City/Town *</label>
                                        <input type="text" name="city" required 
                                               class="w-full border border-rose-soft rounded-sm px-4 py-3 text-sm focus:border-gold-deep focus:ring-1 focus:ring-gold-deep outline-none transition"
                                               value="{{ old('city') }}">
                                        @error('city')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label class="block text-xs uppercase tracking-wider text-slate-500 mb-2">County *</label>
                                        <select name="county" required 
                                                class="w-full border border-rose-soft rounded-sm px-4 py-3 text-sm focus:border-gold-deep focus:ring-1 focus:ring-gold-deep outline-none transition">
                                            <option value="">Select County</option>
                                            <option value="Nairobi">Nairobi</option>
                                            <option value="Mombasa">Mombasa</option>
                                            <option value="Kisumu">Kisumu</option>
                                            <option value="Nakuru">Nakuru</option>
                                            <option value="Kiambu">Kiambu</option>
                                            <option value="Machakos">Machakos</option>
                                            <option value="Uasin Gishu">Uasin Gishu</option>
                                            <option value="Kajiado">Kajiado</option>
                                            <!-- Add more counties -->
                                        </select>
                                        @error('county')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Delivery Method -->
                                <div class="pt-4">
                                    <label class="block text-xs uppercase tracking-wider text-slate-500 mb-3">Delivery Method *</label>
                                    
                                    <div class="space-y-3">
                                        <label class="flex items-center gap-3 cursor-pointer">
                                            <input type="radio" name="delivery_method" value="doorstep" class="text-gold-deep focus:ring-gold-deep" checked>
                                            <span class="text-sm">Doorstep Delivery (1-3 business days)</span>
                                        </label>
                                        
                                        <label class="flex items-center gap-3 cursor-pointer">
                                            <input type="radio" name="delivery_method" value="pickup" class="text-gold-deep focus:ring-gold-deep">
                                            <span class="text-sm">Pick Up Mtaani Agent (Free)</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- Pickup Location (hidden by default) -->
                                <div id="pickupLocationField" class="hidden">
                                    <label class="block text-xs uppercase tracking-wider text-slate-500 mb-2">Select Pickup Location *</label>
                                    <select name="pickup_location" class="w-full border border-rose-soft rounded-sm px-4 py-3 text-sm focus:border-gold-deep focus:ring-1 focus:ring-gold-deep outline-none transition">
                                        <option value="">Choose agent near you</option>
                                        <option value="Nairobi CBD - Moi Avenue">Nairobi CBD - Moi Avenue</option>
                                        <option value="Westlands - Sarit Center">Westlands - Sarit Center</option>
                                        <option value="Kilimani - Adams Arcade">Kilimani - Adams Arcade</option>
                                        <option value="Eastlands - T-Mall">Eastlands - T-Mall</option>
                                        <option value="Thika - Makongeni">Thika - Makongeni</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Method -->
                        <div class="bg-white rounded-sm shadow-[0_5px_20px_rgba(0,0,0,0.02)] p-6 mb-6">
                            <h2 class="text-lg font-medium mb-4 flex items-center gap-2">
                                <span class="w-6 h-6 bg-gold-deep/10 rounded-full flex items-center justify-center text-xs text-gold-deep">3</span>
                                Payment Method
                            </h2>
                            
                            <div class="space-y-3">
                                <label class="flex items-center gap-3 cursor-pointer p-3 border border-rose-soft rounded-sm hover:border-gold-deep/30 transition">
                                    <input type="radio" name="payment_method" value="mpesa" class="text-gold-deep focus:ring-gold-deep" checked>
                                    <span class="flex items-center gap-2">
                                        <img src="data:image/png;base64,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" alt="M-PESA" class="h-6">
                                        <span class="text-sm">M-PESA (Send payment prompt to phone)</span>
                                    </span>
                                </label>
                                
                               
                            </div>
                        </div>
                        
                        <!-- Additional Notes -->
                        <div class="bg-white rounded-sm shadow-[0_5px_20px_rgba(0,0,0,0.02)] p-6">
                            <h2 class="text-lg font-medium mb-4 flex items-center gap-2">
                                <span class="w-6 h-6 bg-gold-deep/10 rounded-full flex items-center justify-center text-xs text-gold-deep">4</span>
                                Additional Notes (Optional)
                            </h2>
                            
                            <textarea name="notes" rows="3" 
                                      class="w-full border border-rose-soft rounded-sm px-4 py-3 text-sm focus:border-gold-deep focus:ring-1 focus:ring-gold-deep outline-none transition"
                                      placeholder="Any special instructions for delivery?">{{ old('notes') }}</textarea>
                        </div>
                    </form>
                </div>
                
                <!-- Right Column - Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-sm shadow-[0_5px_20px_rgba(0,0,0,0.02)] p-6 sticky top-24">
                        <h2 class="text-lg font-medium mb-4">Order Summary</h2>
                        
                        <!-- Cart Items -->
                        <div class="max-h-80 overflow-y-auto mb-4 space-y-3 custom-scrollbar">
                            @forelse($cartItems as $item)
                                <div class="flex gap-3 text-sm">
                                    @if($item['product']->featured_image)
                                        <img src="{{ asset($item['product']->featured_image) }}" 
                                             alt="{{ $item['product']->name }}"
                                             class="w-16 h-16 object-cover rounded-sm">
                                    @else
                                        <div class="w-16 h-16 bg-rose-soft/30 rounded-sm flex items-center justify-center">
                                            <span class="material-symbols-outlined text-slate-400">image</span>
                                        </div>
                                    @endif
                                    
                                    <div class="flex-1">
                                        <h4 class="font-medium">{{ $item['product']->name }}</h4>
                                        <p class="text-xs text-slate-500">
                                            {{ ucfirst($item['size']) }} · Qty: {{ $item['quantity'] }}
                                        </p>
                                        <p class="text-xs text-gold-deep mt-1">Kshs {{ number_format($item['total'], 2) }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-slate-500 text-center py-4">Your cart is empty</p>
                            @endforelse
                        </div>
                        
                        <!-- Totals -->
                        <div class="border-t border-rose-soft pt-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Subtotal</span>
                                <span>Kshs {{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Shipping</span>
                                <span>
                                    @if($shipping > 0)
                                        Kshs {{ number_format($shipping, 2) }}
                                    @else
                                        <span class="text-green-600">Free</span>
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between text-lg font-medium pt-2 border-t border-rose-soft">
                                <span>Total</span>
                                <span class="text-gold-deep">Kshs {{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                        
                        <!-- Place Order Button -->
                        <button type="submit" form="checkoutForm" class="w-full bg-gold-deep text-white py-4 rounded-full text-sm tracking-widest uppercase hover:opacity-90 transition mt-6">
                            Place Order
                        </button>
                        
                        <!-- Security Notice -->
                        <p class="text-xs text-center text-slate-400 mt-4 flex items-center justify-center gap-1">
                            <span class="material-symbols-outlined text-sm">lock</span>
                            Secure checkout · Your info is protected
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@push('scripts')
<script>
    // Toggle pickup location field based on delivery method
    document.querySelectorAll('input[name="delivery_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const pickupField = document.getElementById('pickupLocationField');
            if (this.value === 'pickup') {
                pickupField.classList.remove('hidden');
                document.querySelector('select[name="pickup_location"]').setAttribute('required', 'required');
            } else {
                pickupField.classList.add('hidden');
                document.querySelector('select[name="pickup_location"]').removeAttribute('required');
            }
        });
    });
    
    // Format phone number as user types
    document.querySelector('input[name="phone"]').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 0) {
            if (value.startsWith('0')) {
                value = '254' + value.substring(1);
            }
            if (value.length > 9) {
                value = value.substring(0, 12);
            }
        }
        e.target.value = value;
    });
</script>
@endpush
@endsection