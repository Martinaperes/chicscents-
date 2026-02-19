@extends('layouts.app')

@section('title', 'All Fragrances | Chic Scents')

@section('content')
<main class="pb-32">
    <!-- Page Header -->
    <div class="bg-rose-soft/30 py-16 text-center">
        <div class="max-w-7xl mx-auto px-8">
            <h1 class="text-4xl md:text-5xl serif-heading font-light mb-4">All Fragrances</h1>
            <p class="text-slate-500 max-w-2xl mx-auto">
                Discover our curated collection of luxury perfumes. Each fragrance tells a unique story.
            </p>
        </div>
    </div>

    <!-- Products Grid - Using Flexbox with fixed widths -->
    <div class="max-w-7xl mx-auto px-8 py-12">
        @if($perfumes->count() > 0)
            <!-- Flexbox container with wrapping and space between -->
            <div class="flex flex-wrap justify-between">
                @foreach($perfumes as $perfume)
                    <div class="mb-8">
                        <x-product-card 
                            :name="$perfume->name"
                            :notes="$perfume->display_notes ?? $perfume->notes"
                            :price="$perfume->price"
                            :image="$perfume->featured_image"
                            :slug="$perfume->slug"
                            :brand="$perfume->brand->name ?? null"
                            :rating="$perfume->average_rating"
                            :review-count="$perfume->review_count"
                            :is-new="$perfume->is_new"
                            :is-bestseller="$perfume->is_bestseller"
                            :featured="$perfume->is_featured"
                        />
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $perfumes->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-slate-400">No products found.</p>
            </div>
        @endif
    </div>
    <x-cookie />
</main>
@endsection