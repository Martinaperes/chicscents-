<header class="sticky top-11 z-50 bg-ivory/80 backdrop-blur-md border-b border-gold-deep/10">
    <nav class="flex items-center justify-between px-6 py-4">
        <button class="p-1">
            <span class="material-symbols-outlined text-2xl font-light">menu</span>
        </button>
        
        <h1 class="text-xl serif-heading font-semibold tracking-[0.15em] uppercase">
            ScentCepts
        </h1>
        
        <div class="relative">
            <button class="p-1">
                <span class="material-symbols-outlined text-2xl font-light">shopping_bag</span>
            </button>
            @if(session('cart_count', 0) > 0)
                <span class="absolute -top-0 -right-0 bg-gold-deep text-white text-[9px] w-4 h-4 rounded-full flex items-center justify-center font-medium">
                    {{ session('cart_count', 2) }}
                </span>
            @endif
        </div>
    </nav>
</header>