@props([
    'name' => '',
    'notes' => '',
    'price' => 0,
    'originalPrice' => null,
    'image' => '',
    'slug' => '#',
    'featured' => false,
    'isNew' => false,
    'isBestseller' => false,
    'isSale' => false,
    'discountPercentage' => null,
    'brand' => null,
    'rating' => null,
    'reviewCount' => 0,
    'id' => null
])

<div class="snap-center shrink-0 w-72 group">
    <a href="{{ route('products.show', $slug) }}" class="block">
        <div class="aspect-[3/4] bg-white rounded-sm overflow-hidden relative mb-5 shadow-[0_10px_30px_rgba(0,0,0,0.04)] group-hover:shadow-[0_15px_45px_rgba(0,0,0,0.08)] transition-shadow duration-500">
            @if($image)
                <img 
                    alt="{{ $name }}" 
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                    src="{{ asset($image) }}"
                />
            @else
                <div class="w-full h-full bg-ivory flex items-center justify-center">
                    <span class="text-slate-400 text-xs">No image</span>
                </div>
            @endif
            
            <!-- Badges Section - Top Left -->
            <div class="absolute top-4 left-4 flex flex-col gap-2">
                @if($featured)
                    <span class="px-3 py-1.5 bg-gold-deep/90 text-white text-[9px] uppercase tracking-widest rounded-full shadow-sm">
                        Featured
                    </span>
                @endif
                
                @if($isNew)
                    <span class="px-3 py-1.5 bg-blue-500/90 text-white text-[9px] uppercase tracking-widest rounded-full shadow-sm">
                        New
                    </span>
                @endif
                
                @if($isBestseller)
                    <span class="px-3 py-1.5 bg-purple-600/90 text-white text-[9px] uppercase tracking-widest rounded-full shadow-sm">
                        Best Seller
                    </span>
                @endif
            </div>
            
            <!-- Sale Badge - Top Right -->
            @if($isSale && $discountPercentage)
                <span class="absolute top-4 right-4 px-3 py-1.5 bg-red-500/90 text-white text-[9px] uppercase tracking-widest rounded-full shadow-sm">
                    -{{ $discountPercentage }}%
                </span>
            @endif
            
            <!-- Add to Cart Button -->
            <button 
                class="absolute bottom-6 right-6 bg-ivory/90 backdrop-blur-sm text-gold-deep p-3 rounded-full shadow-sm hover:bg-gold-deep hover:text-white transition-colors duration-300 z-10"
                @if($id) onclick="addToCart({{ $id }}, '{{ $slug }}')" @endif
            >
                <span class="material-symbols-outlined text-xl font-light">add</span>
            </button>
        </div>
        
        <div class="text-center">
            @if($brand)
                <p class="text-[9px] uppercase tracking-[0.2em] text-gold-deep mb-1">{{ $brand }}</p>
            @endif
            
            <h4 class="serif-heading text-xl font-medium mb-1">{{ $name }}</h4>
            
            @if($notes)
                <p class="text-[10px] uppercase tracking-[0.15em] text-slate-400 mb-2">{{ $notes }}</p>
            @endif
            
            <!-- Rating Stars -->
            @if($rating && $rating > 0)
                <div class="flex items-center justify-center gap-1 mb-2">
                    <div class="flex">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-3 h-3 {{ $i <= round($rating) ? 'text-gold-deep' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <span class="text-[9px] text-slate-500">({{ $reviewCount }})</span>
                </div>
            @endif
            
            <!-- Price Section - Updated to Kshs -->
            <div class="flex items-center justify-center gap-2">
                @if($isSale)
                    <span class="text-gold-deep font-medium text-sm">Kshs {{ number_format($price, 2) }}</span>
                    <span class="text-slate-400 text-xs line-through">Kshs {{ number_format($originalPrice, 2) }}</span>
                @else
                    <span class="text-gold-deep font-medium text-sm">Kshs {{ number_format($price, 2) }}</span>
                @endif
            </div>
        </div>
    </a>
</div>

@push('scripts')
<script>
function addToCart(productId, productSlug) {
    console.log('Adding to cart:', productId, productSlug);
    alert('Added to cart!');
}
</script>
@endpush