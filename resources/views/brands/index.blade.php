@extends('layouts.app')

@section('title', 'Our Brands | ScentCepts')

@section('content')
<main class="pb-16 md:pb-32">
    <!-- Hero Section -->
    <section class="relative h-[30vh] md:h-[40vh] min-h-[250px] md:min-h-[300px] overflow-hidden">
       
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="absolute inset-0 flex items-center justify-center text-center text-white px-4">
            <div>
                <span class="text-[10px] md:text-[11px] uppercase tracking-[0.3em] md:tracking-[0.5em] font-medium text-gold-deep mb-3 md:mb-4 block">
                    Curated For You
                </span>
                <h1 class="text-3xl md:text-5xl lg:text-7xl serif-heading font-light mb-3 md:mb-6">
                    Our <span class="italic text-gold-deep">Brands</span>
                </h1>
                <p class="text-xs md:text-sm lg:text-base max-w-2xl mx-auto font-light text-gray-200 px-4">
                    Discover the world's most prestigious perfume houses, carefully selected for the discerning Kenyan fragrance lover.
                </p>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <x-divider />

    <!-- Brands Grid Section -->
    <section class="py-12 md:py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Section Intro -->
            <div class="text-center mb-10 md:mb-16">
                <span class="text-[8px] md:text-[10px] uppercase tracking-[0.2em] md:tracking-[0.3em] text-gold-deep font-semibold mb-3 md:mb-4 block">
                    Prestige Houses
                </span>
                <h2 class="text-2xl md:text-3xl lg:text-4xl serif-heading font-light mb-4 md:mb-6">
                    Explore Our <span class="italic text-gold-deep">Collection</span>
                </h2>
                <p class="text-xs md:text-sm text-slate-500 max-w-2xl mx-auto px-4">
                    From Arabian luxury to French sophistication, we bring you the finest fragrance houses from around the globe.
                </p>
            </div>

            <!-- Brands Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 lg:gap-8">
                @forelse($brands ?? [] as $brand)
                    <a href="{{ route('brands.show', $brand->slug) }}" class="group">
                        <div class="bg-white rounded-sm overflow-hidden shadow-[0_5px_20px_rgba(0,0,0,0.02)] hover:shadow-[0_10px_30px_rgba(0,0,0,0.08)] transition-all duration-500">
                            <!-- Brand Image -->
                            <div class="aspect-[16/9] bg-white relative overflow-hidden flex items-center justify-center p-4 md:p-6">
    @if(!empty($brand->logo) && file_exists(public_path($brand->logo)))
        <img 
            src="{{ asset($brand->logo) }}" 
            alt="{{ $brand->name }}"
            class="max-w-full max-h-full w-auto h-auto object-contain group-hover:scale-105 transition-transform duration-700"
            loading="lazy"
        />
    @else
        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gold-deep/5 to-rose-soft/10">
            <span class="text-2xl md:text-3xl serif-heading text-gold-deep/30">{{ Str::limit($brand->name, 2, '') }}</span>
        </div>
    @endif
</div>

                            <!-- Brand Info -->
                            <div class="p-4 md:p-6 text-center">
                                <h3 class="text-lg md:text-xl serif-heading font-medium mb-1 md:mb-2 group-hover:text-gold-deep transition">
                                    {{ $brand->name }}
                                </h3>
                                
                                @if(!empty($brand->country))
                                    <p class="text-[8px] md:text-[10px] uppercase tracking-[0.1em] md:tracking-[0.2em] text-slate-400 mb-2 md:mb-3">
                                        {{ $brand->country }}
                                    </p>
                                @endif

                                @if(!empty($brand->description))
                                    <p class="text-xs md:text-sm text-slate-500 line-clamp-2">
                                        {{ $brand->description }}
                                    </p>
                                @endif

                                <!-- Perfume Count -->
                                @php
                                    $perfumeCount = optional($brand->perfumes)->count() ?? 0;
                                @endphp
                                @if($perfumeCount > 0)
                                    <div class="mt-3 md:mt-4">
                                        <span class="text-[10px] md:text-xs text-gold-deep">
                                            {{ $perfumeCount }} {{ Str::plural('fragrance', $perfumeCount) }}
                                        </span>
                                    </div>
                                @endif

                                <!-- View Button -->
                                <div class="mt-3 md:mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <span class="text-[8px] md:text-[10px] uppercase tracking-[0.1em] md:tracking-[0.2em] text-gold-deep border-b border-gold-deep/30 pb-1">
                                        View Collection
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <!-- Sample Brands (when no database brands yet) -->
                    @php
                        $sampleBrands = [
                            [
                                'name' => 'Lattafa',
                                'country' => 'UAE',
                                'description' => 'Lattafa Perfumes is a renowned fragrance house from the United Arab Emirates, known for its exquisite oriental and western perfume creations.',
                                'perfume_count' => 3,
                                'slug' => 'lattafa'
                            ],
                            [
                                'name' => 'Maison de Luxe',
                                'country' => 'France',
                                'description' => 'Premium French perfumery since 1924, creating sophisticated scents for the modern connoisseur.',
                                'perfume_count' => 0,
                                'slug' => '#'
                            ],
                            [
                                'name' => 'Aura Collection',
                                'country' => 'Italy',
                                'description' => 'Modern fragrances for the contemporary soul, blending traditional Italian craftsmanship with innovative scent profiles.',
                                'perfume_count' => 0,
                                'slug' => '#'
                            ],
                            [
                                'name' => 'Arabian Oud',
                                'country' => 'Saudi Arabia',
                                'description' => 'Master perfumers specializing in rich, complex oud-based fragrances that capture the essence of Arabian luxury.',
                                'perfume_count' => 0,
                                'slug' => '#'
                            ],
                            [
                                'name' => 'ScentCepts Signature',
                                'country' => 'Kenya',
                                'description' => 'Our very own collection, crafted exclusively for the Kenyan fragrance lover who appreciates accessible luxury.',
                                'perfume_count' => 2,
                                'slug' => '#'
                            ],
                            [
                                'name' => 'Velvet Collection',
                                'country' => 'UK',
                                'description' => 'British elegance meets contemporary perfumery in this sophisticated range of modern classics.',
                                'perfume_count' => 0,
                                'slug' => '#'
                            ]
                        ];
                    @endphp

                    @foreach($sampleBrands as $brand)
                        <a href="{{ $brand['slug'] !== '#' ? route('brands.show', $brand['slug']) : '#' }}" 
                           class="group {{ $brand['slug'] === '#' ? 'cursor-not-allowed opacity-80' : '' }}"
                           @if($brand['slug'] === '#') onclick="return false;" @endif>
                            <div class="bg-white rounded-sm overflow-hidden shadow-[0_5px_20px_rgba(0,0,0,0.02)] hover:shadow-[0_10px_30px_rgba(0,0,0,0.08)] transition-all duration-500">
                                <!-- Brand Image Placeholder -->
                                <div class="aspect-[16/9] bg-gradient-to-br from-gold-deep/5 to-rose-soft/30 relative overflow-hidden flex items-center justify-center">
                                    <span class="text-3xl md:text-4xl serif-heading font-light text-gold-deep/20">
                                        {{ substr($brand['name'], 0, 1) }}
                                    </span>
                                </div>

                                <!-- Brand Info -->
                                <div class="p-4 md:p-6 text-center">
                                    <h3 class="text-lg md:text-xl serif-heading font-medium mb-1 md:mb-2 group-hover:text-gold-deep transition">
                                        {{ $brand['name'] }}
                                    </h3>
                                    
                                    <p class="text-[8px] md:text-[10px] uppercase tracking-[0.1em] md:tracking-[0.2em] text-slate-400 mb-2 md:mb-3">
                                        {{ $brand['country'] }}
                                    </p>

                                    <p class="text-xs md:text-sm text-slate-500 line-clamp-2">
                                        {{ $brand['description'] }}
                                    </p>

                                    @if($brand['perfume_count'] > 0)
                                        <div class="mt-3 md:mt-4">
                                            <span class="text-[10px] md:text-xs text-gold-deep">
                                                {{ $brand['perfume_count'] }} {{ Str::plural('fragrance', $brand['perfume_count']) }}
                                            </span>
                                        </div>
                                    @endif

                                    <div class="mt-3 md:mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <span class="text-[8px] md:text-[10px] uppercase tracking-[0.1em] md:tracking-[0.2em] text-gold-deep border-b border-gold-deep/30 pb-1">
                                            {{ $brand['perfume_count'] > 0 ? 'View Collection' : 'Coming Soon' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- Divider -->
    <x-divider />

    <!-- Featured Brand Section (Lattafa Feature) -->
    @php
        $lattafaExists = isset($brands) && $brands->contains('name', 'Lattafa');
    @endphp
    
    <section class="py-12 md:py-20 px-4 sm:px-6 lg:px-8 bg-rose-soft/20">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16 items-center">
                <div class="order-2 md:order-1">
                    <span class="text-[8px] md:text-[10px] uppercase tracking-[0.2em] md:tracking-[0.3em] text-gold-deep font-semibold mb-3 md:mb-4 block">Featured Brand</span>
                    <h2 class="text-2xl md:text-3xl lg:text-4xl serif-heading font-light mb-4 md:mb-6">Lattafa <span class="italic text-gold-deep">Perfumes</span></h2>
                    <p class="text-xs md:text-sm text-slate-600 leading-relaxed mb-4 md:mb-6">
                        Hailing from the United Arab Emirates, Lattafa has mastered the art of creating exquisite oriental 
                        fragrances that capture the richness of Arabian heritage. Their perfumes are known for exceptional 
                        longevity, complex compositions, and incredible value.
                    </p>
                    <p class="text-xs md:text-sm text-slate-600 leading-relaxed mb-6 md:mb-8">
                        From the warm, spicy notes of Khamrah to the fresh elegance of Ramz Silver, Lattafa offers something 
                        for every fragrance lover. Now available at ScentCepts in both decants and full bottles.
                    </p>
                    <a href="{{ $lattafaExists ? route('products.index', ['brand' => 'lattafa']) : '#' }}" 
                       class="inline-block bg-gold-deep text-white px-6 md:px-8 py-2.5 md:py-3 rounded-full text-[10px] md:text-xs tracking-widest uppercase hover:opacity-90 transition {{ !$lattafaExists ? 'opacity-50 pointer-events-none' : '' }}">
                        Shop Lattafa Collection
                    </a>
                </div>
                <div class="relative order-1 md:order-2 mb-6 md:mb-0">
                    <div class="aspect-[4/5] bg-white rounded-sm overflow-hidden shadow-xl">
                        <img 
                            src="{{ asset('images/hero/lataffa logo.jpg') }}" 
                            alt="Lattafa perfumes"
                            class="w-full h-full object-cover"
                            onerror="this.onerror=null; this.src='https://via.placeholder.com/400x500?text=Lattafa';"
                        />
                    </div>
                    <!-- Decorative element -->
                    <div class="absolute -bottom-3 md:-bottom-6 -right-3 md:-right-6 w-16 md:w-32 h-16 md:h-32 border border-gold-deep/20 rounded-sm -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <x-divider />

    <!-- Why Choose Our Brands Section -->
    <section class="py-12 md:py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-10 md:mb-16">
                <span class="text-[8px] md:text-[10px] uppercase tracking-[0.2em] md:tracking-[0.3em] text-gold-deep font-semibold mb-3 md:mb-4 block">Quality Assured</span>
                <h2 class="text-2xl md:text-3xl lg:text-4xl serif-heading font-light mb-4 md:mb-6">Why We Choose <span class="italic text-gold-deep">Our Brands</span></h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8">
                <div class="text-center px-4">
                    <div class="w-12 h-12 md:w-16 md:h-16 mx-auto mb-4 md:mb-6 bg-gold-deep/10 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-xl md:text-3xl text-gold-deep">verified</span>
                    </div>
                    <h3 class="text-base md:text-lg font-medium mb-2 md:mb-3">100% Authentic</h3>
                    <p class="text-xs md:text-sm text-slate-500">
                        Every brand we carry is sourced directly from authorized distributors. Never counterfeits.
                    </p>
                </div>

                <div class="text-center px-4">
                    <div class="w-12 h-12 md:w-16 md:h-16 mx-auto mb-4 md:mb-6 bg-gold-deep/10 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-xl md:text-3xl text-gold-deep">award_star</span>
                    </div>
                    <h3 class="text-base md:text-lg font-medium mb-2 md:mb-3">Curated Selection</h3>
                    <p class="text-xs md:text-sm text-slate-500">
                        We personally test and select only the finest fragrances that meet our quality standards.
                    </p>
                </div>

                <div class="text-center px-4 sm:col-span-2 md:col-span-1">
                    <div class="w-12 h-12 md:w-16 md:h-16 mx-auto mb-4 md:mb-6 bg-gold-deep/10 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-xl md:text-3xl text-gold-deep">globe</span>
                    </div>
                    <h3 class="text-base md:text-lg font-medium mb-2 md:mb-3">Global Collection</h3>
                    <p class="text-xs md:text-sm text-slate-500">
                        From Arabian houses to French maisons, we bring the world's best fragrances to you.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <x-divider />

    <!-- Brand Inquiry Section -->
    <section class="py-12 md:py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <span class="text-[8px] md:text-[10px] uppercase tracking-[0.2em] md:tracking-[0.3em] text-gold-deep font-semibold mb-3 md:mb-4 block">Love a Brand?</span>
            <h2 class="text-2xl md:text-3xl lg:text-4xl serif-heading font-light mb-4 md:mb-6">Don't See Your <span class="italic text-gold-deep">Favorite?</span></h2>
            <p class="text-xs md:text-sm text-slate-500 max-w-2xl mx-auto mb-6 md:mb-10 px-4">
                We're always expanding our collection. Let us know which brands you'd love to see at ScentCepts, 
                and we'll do our best to bring them.
            </p>
            <a href="https://wa.me/254716052342?text=Hi%20Chic%20Scents%2C%20I'd%20love%20to%20see%20[brand%20name]%20in%20your%20collection" 
               target="_blank"
               class="inline-flex items-center gap-2 md:gap-3 bg-green-500 hover:bg-green-600 text-white px-6 md:px-8 py-3 md:py-4 rounded-full text-[10px] md:text-sm font-medium tracking-wider uppercase transition-all duration-300 shadow-md hover:shadow-lg">
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12c0 2.13.67 4.1 1.8 5.72L2.3 21.7l3.98-1.5C8.1 21.2 9.98 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2z"/>
                </svg>
                Suggest a Brand on WhatsApp
            </a>
            <p class="text-[10px] md:text-xs text-slate-400 mt-3 md:mt-4">
                0716 052342
            </p>
        </div>
    </section>
</main>
@endsection