<!-- Recently Viewed Products -->
@php
    $recentIds = json_decode(Cookie::get('recent_products', '[]'), true);
    $recentProducts = !empty($recentIds) ? App\Models\Product::whereIn('id', $recentIds)->get() : collect([]);
@endphp

@if($recentProducts->count() > 0)
    <div class="mt-8 p-4 bg-rose-soft/10 rounded">
        <h4 class="text-sm font-medium mb-3">Recently Viewed</h4>
        <div class="space-y-3">
            @foreach($recentProducts as $recent)
                <a href="{{ route('products.show', $recent->slug) }}" class="flex items-center gap-3 text-xs hover:text-gold-deep transition">
                    @if($recent->featured_image)
                        <img src="{{ asset($recent->featured_image) }}" class="w-10 h-10 object-cover rounded" alt="">
                    @else
                        <div class="w-10 h-10 bg-rose-soft/30 rounded flex items-center justify-center">
                            <span class="material-symbols-outlined text-slate-400">image</span>
                        </div>
                    @endif
                    <span>{{ $recent->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
@endif