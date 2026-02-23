@extends('layouts.app')

@section('title', $familyName . ' Fragrances | Chic Scents')

@section('content')
    <!-- Top Spacer -->
    <div class="h-11 w-full bg-ivory/90"></div>

    <main class="pb-32">
        <!-- Header -->
        <div class="px-8 py-16 bg-rose-soft/20 text-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gold-deep/20 to-transparent"></div>
            
            <span class="text-[10px] uppercase tracking-[0.5em] font-semibold text-gold-deep mb-4 block">
                Olfactory Family
            </span>
            
            <h1 class="text-5xl md:text-6xl serif-heading font-light mb-6">
                {{ $familyName }}
            </h1>
            
            <p class="text-slate-500 max-w-2xl mx-auto mb-8">
                {{ $familyDescription }}
            </p>

            <!-- Family Navigation Pills -->
            <div class="flex flex-wrap justify-center gap-2 mt-8">
                @foreach($families as $key => $fam)
                    <a href="{{ route('olfactory.family', $key) }}" 
                       class="px-4 py-2 rounded-full text-xs uppercase tracking-wider transition
                              {{ $key === $family ? 'bg-gold-deep text-white' : 'bg-rose-soft/50 text-slate-600 hover:bg-gold-deep/20' }}">
                        {{ $fam['name'] }}
                    </a>
                @endforeach
            </div>

            <div class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gold-deep/20 to-transparent"></div>
        </div>

        <!-- Breadcrumb -->
        <div class="px-8 py-6 border-b border-rose-soft">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center gap-2 text-xs text-slate-400">
                    <a href="{{ route('home') }}" class="hover:text-gold-deep transition">Home</a>
                    <span>/</span>
                    <a href="{{ route('products.index') }}" class="hover:text-gold-deep transition">Shop</a>
                    <span>/</span>
                    <span class="text-gold-deep">{{ $familyName }} Fragrances</span>
                </div>
            </div>
        </div>

        <!-- Results Count -->
        <div class="px-8 mt-8">
            <div class="max-w-7xl mx-auto">
                <p class="text-sm text-slate-500">
                    Found <span class="text-gold-deep font-medium">{{ $perfumes->total() }}</span> fragrances in the 
                    <span class="font-medium">{{ $familyName }}</span> family
                </p>
            </div>
        </div>

        <!-- Perfumes Grid -->
        <section class="px-8 mt-8">
            <div class="max-w-7xl mx-auto">
                @if($perfumes->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        @foreach($perfumes as $perfume)
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
                                :is-new="$perfume->is_new"
                                :is-bestseller="$perfume->is_bestseller"
                                :is-sale="$perfume->is_on_sale"
                                :discount-percentage="$perfume->discount_percentage"
                            />
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-16">
                        {{ $perfumes->links() }}
                    </div>
                @else
                    <div class="text-center py-16">
                        <span class="material-symbols-outlined text-6xl text-slate-300 mb-4">search_off</span>
                        <h3 class="text-xl serif-heading font-light mb-2">No fragrances found</h3>
                        <p class="text-slate-500 mb-4">We couldn't find any {{ $familyName }} fragrances yet.</p>
                        <p class="text-sm text-slate-400 max-w-md mx-auto mb-8">
                            {{ $familyDescription }}
                        </p>
                        <a href="{{ route('products.index') }}" class="inline-block text-gold-deep hover:underline">
                            Browse all fragrances →
                        </a>
                    </div>
                @endif
            </div>
        </section>

        <!-- Family Characteristics -->
        <section class="px-8 mt-20">
            <div class="max-w-4xl mx-auto">
                <div class="bg-rose-soft/20 rounded-lg p-8">
                    <h3 class="text-sm uppercase tracking-widest text-gold-deep mb-4 text-center">
                        About {{ $familyName }} Fragrances
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h4 class="text-xs uppercase tracking-wider font-medium mb-3">Characteristic Notes</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach(array_slice($families[$family]['keywords'], 0, 8) as $note)
                                    <span class="text-xs bg-white px-3 py-1 rounded-full text-slate-600">
                                        {{ ucfirst($note) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="text-xs uppercase tracking-wider font-medium mb-3">Perfect For</h4>
                            @php
                                $perfectFor = [
                                    'floral' => 'Romantic occasions, spring and summer weddings, feminine energy',
                                    'woody' => 'Evening wear, autumn and winter, grounded personalities',
                                    'oriental' => 'Date nights, cold weather, sensual and mysterious',
                                    'fresh' => 'Daytime, office wear, active lifestyles, summer days',
                                    'green' => 'Nature lovers, spring, professional settings',
                                    'fruity' => 'Young at heart, summer, playful personalities',
                                    'gourmand' => 'Cozy days, winter, comfort seekers, dessert lovers',
                                    'leather' => 'Bold statements, night outs, sophisticated tastes',
                                    'aromatic' => 'Sporty, daytime, herbal enthusiasts, men\'s fragrances'
                                ];
                            @endphp
                            <p class="text-sm text-slate-600">
                                {{ $perfectFor[$family] ?? 'Various occasions and preferences' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection