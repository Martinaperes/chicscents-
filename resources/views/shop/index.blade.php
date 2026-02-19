@extends('layouts.app')

@section('title', 'Shop All Fragrances | Chic Scents')

@section('content')
    <!-- Top Spacer -->
    <div class="h-11 w-full bg-ivory/90 sticky top-0 z-50 backdrop-blur-md"></div>
    
    <!-- Header -->
    <x-header-home />

    <main class="pb-32">
        <div class="px-8 py-12">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-4xl serif-heading font-light text-center mb-4">All Fragrances</h1>
                <p class="text-center text-slate-500 mb-12">Discover our collection of luxury scents</p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @forelse($perfumes as $perfume)
                        <x-product-card 
                            :name="$perfume->name"
                            :notes="$perfume->display_notes ?? $perfume->notes"
                            :price="$perfume->current_price"
                            :original-price="$perfume->is_on_sale ? $perfume->price : null"
                            :image="$perfume->featured_image"
                            :slug="$perfume->slug"
                            :id="$perfume->id"
                            :featured="$perfume->is_featured"
                            :is-new="$perfume->is_new"
                            :is-bestseller="$perfume->is_bestseller"
                            :is-sale="$perfume->is_on_sale"
                            :discount-percentage="$perfume->discount_percentage"
                            :brand="$perfume->brand->name ?? null"
                            :rating="$perfume->average_rating"
                            :review-count="$perfume->review_count"
                        />
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-slate-400">No perfumes found.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $perfumes->links() }}
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <x-footer-home />
@endsection