@extends('layouts.app')

@section('title', 'Chic Scents | Luxury Fragrances')

@section('content')
    <!-- Top Spacer -->
    <div class="h-11 w-full bg-ivory/90 sticky top-0 z-50 backdrop-blur-md"></div>
    
 

    <main class="pb-32">
      <!-- Hero Section -->
<section class="relative w-full h-[80vh] overflow-hidden">

    <!-- Background Image -->
    <img 
        src="{{ asset('images/hero/perfume scents.jpg') }}"
        alt="Chic Scents luxury perfume"
        class="absolute inset-0 w-full h-full object-cover"
    />

    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Hero Content -->
    <div class="relative z-10 flex items-end justify-center h-full px-6 pb-24 text-center text-white">
        <div>
            <span class="text-[11px] uppercase tracking-[0.5em] font-medium text-gold-deep mb-4 block">
                Chic Scents
            </span>

            <h2 class="text-5xl md:text-6xl serif-heading font-light tracking-tight mb-6 leading-tight">
                Luxury Fragrances <br/>
                <span class="italic text-gold-deep">In Every Size</span>
            </h2>

            <p class="text-sm md:text-base leading-relaxed mb-10 max-w-md mx-auto font-light text-gray-200">
                Discover authentic  perfumes available in elegant decants and full bottles.
                Smell expensive. Spend smart.
            </p>

            <div class="flex justify-center gap-4 flex-wrap">
                <a href="/decants"
                   class="bg-gold-deep text-white px-10 py-3 rounded-full text-xs tracking-widest uppercase hover:opacity-90 transition">
                    Shop Decants
                </a>

                <a href="/full-bottles"
                   class="border border-white text-white px-10 py-3 rounded-full text-xs tracking-widest uppercase hover:bg-white hover:text-black transition">
                    Shop Full Bottles
                </a>
            </div>
        </div>
    </div>

    <!-- ✨ Smooth Bottom Fade -->
    <div class="absolute bottom-0 left-0 w-full h-40 
                bg-gradient-to-b from-transparent via-white/60 to-white">
    </div>

</section>


        <!-- Divider -->
        <x-divider />

        
       <!-- Featured Scents Section -->
<!-- Featured Scents Section -->
<section class="mt-4">
    <div class="flex items-end justify-between px-8 mb-8">
        <div>
            <span class="text-[10px] uppercase tracking-[0.2em] text-gold-deep font-semibold mb-1 block">
                Curated
            </span>
            <h3 class="text-2xl serif-heading font-medium tracking-wide">Featured Scents</h3>
        </div>
        <a href="/shop" class="text-gold-deep text-xs font-medium uppercase tracking-widest border-b border-gold-deep/30 pb-1">
            View All
        </a>
    </div>

    <!-- Grid layout with 3 columns -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-8">
        @forelse($featuredPerfumes as $perfume)
            <x-product-card 
                :name="$perfume->name"
                :notes="$perfume->display_notes ?? $perfume->notes"
                :price="$perfume->current_price"
                :original-price="$perfume->is_on_sale ? $perfume->price : null"
                :image="$perfume->featured_image"
                :slug="$perfume->slug"
                :brand="$perfume->brand->name ?? null"
                :rating="$perfume->average_rating"
                :review-count="$perfume->review_count"
                
                {{-- :is-new="$perfume->is_new" --}}
                {{-- :is-bestseller="$perfume->is_bestseller" --}}
                :is-sale="$perfume->is_on_sale"
                :discount-percentage="$perfume->discount_percentage"
            />
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-slate-400">No featured perfumes yet. Add some in the admin panel!</p>
            </div>
        @endforelse
    </div>
</section> 

        <!-- Divider -->
        <x-divider />

        <!-- Olfactory Families -->
<!-- Olfactory Families -->
<section class="mt-4 px-8">
    <div class="text-center mb-10">
        <span class="text-[10px] uppercase tracking-[0.2em] text-gold-deep font-semibold mb-1 block">
            Discover By Note
        </span>
        <h3 class="text-2xl serif-heading font-medium tracking-wide mb-2">Olfactory Families</h3>
        <p class="text-[11px] text-slate-400 uppercase tracking-widest font-light">Find your signature scent family</p>
    </div>

    @php
        // Define the families with their images from your hero folder
        $olfactoryFamilies = [
            'floral' => [
                'name' => 'Floral',
                'image' => 'images/hero/floral.jpg', // Using your existing hero image
                'color' => 'bg-rose-soft/20'
            ],
            'woody' => [
                'name' => 'Woody',
                'image' => 'images/hero/woody.jpg', // Using your existing hero image
                'color' => 'bg-gold-deep/10'
            ],
            'oriental' => [
                'name' => 'Oriental',
                'image' => 'images/hero/amber.jpg', // Using your existing hero image
                'color' => 'bg-amber-900/20'
            ],
            'fresh' => [
                'name' => 'Fresh',
                'image' => 'images/hero/fresh.jpg', // Using your existing hero image
                'color' => 'bg-blue-200/20'
            ],
            'green' => [
                'name' => 'Green',
                'image' => 'images/hero/green.jpg', // Using your existing hero image
                'color' => 'bg-green-200/20'
            ],
            'fruity' => [
                'name' => 'Fruity',
                'image' => 'images/hero/fruity.jpg', // Using your existing hero image
                'color' => 'bg-pink-300/20'
            ],
            'gourmand' => [
                'name' => 'Gourmand',
                'image' => 'images/hero/gourmand.jpg', // Using your existing hero image
                'color' => 'bg-amber-700/20'
            ],
            'leather' => [
                'name' => 'Leather',
                'image' => 'images/hero/leather.jpg', // Using your existing hero image
                'color' => 'bg-amber-900/30'
            ],
            'aromatic' => [
                'name' => 'Aromatic',
                'image' => 'images/hero/aromatic.jpg', // Using your existing hero image
                'color' => 'bg-emerald-200/20'
            ]
        ];
    @endphp

    <!-- Grid layout with 3 columns for 9 families -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($olfactoryFamilies as $key => $family)
            <a href="{{ route('olfactory.family', $key) }}" 
               class="relative aspect-[4/5] overflow-hidden group cursor-pointer">
                
                <!-- Background Image from hero folder -->
                <img 
                    src="{{ asset($family['image']) }}"
                    alt="{{ $family['name'] }}"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                />
                
                <!-- Colored Overlay -->
                <div class="absolute inset-0 {{ $family['color'] }} flex items-center justify-center 
                            backdrop-none group-hover:backdrop-blur-[2px] transition-all duration-500">
                    
                    <!-- Family Name -->
                    <span class="text-white text-xs font-medium tracking-[0.3em] uppercase 
                                 bg-black/10 px-4 py-2 backdrop-blur-md 
                                 group-hover:bg-gold-deep/30 group-hover:scale-105 transition-all duration-300">
                        {{ $family['name'] }}
                    </span>
                </div>

                <!-- Hover Effect - Gold Border -->
                <div class="absolute inset-0 border-2 border-transparent group-hover:border-gold-deep/50 
                            transition-all duration-500 pointer-events-none"></div>
            </a>
        @endforeach
    </div>

    <!-- Optional: Add a note about the families -->
    <div class="text-center mt-8">
        <p class="text-xs text-slate-400">
            Click on any family to discover fragrances with those characteristic notes
        </p>
    </div>
</section>
        <!-- Atelier Section -->
        <section class="mt-20 px-8 py-20 bg-rose-soft/30 text-center relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gold-deep/20 to-transparent"></div>
    <span class="text-[10px] uppercase tracking-[0.5em] font-semibold text-gold-deep mb-6 block">The Art of Discovery</span>
    <p class="text-3xl serif-heading italic leading-snug text-slate-luxe mb-8">
        "Every decant is a journey. <br/>Every bottle, a destination."
    </p>
    <p class="text-sm text-slate-500 max-w-xs mx-auto mb-10 leading-relaxed font-light">
        Born from a passion for fragrance, Chic Scents helps you explore 
        the world of perfumery without commitment. Sample first, then 
        invest in the scents you truly love.
    </p>
    <a href="/about"  class="text-gold-deep font-medium text-xs uppercase tracking-[0.3em] border-b border-gold-deep/40 pb-2 inline-block">
        Read Our Story
    </a>
    <div class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gold-deep/20 to-transparent"></div>
</section>

        <!-- Newsletter -->
        <x-newsletter />
    </main>

    <!-- Footer -->
    
@endsection