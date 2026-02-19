<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Chic Scents | Luxury Fragrances')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Montserrat:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    
    @stack('styles')
    
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#e619a1",
                        "background-light": "#f8f6f7",
                        "background-dark": "#21111c",
                        "champagne": "#F7E7CE",
                        "gold-deep": "#C5A059",
                        "gold-light": "#D4AF37",
                        "ivory": "#FCFBF7",
                        "rose-soft": "#F4E4E4",
                        "rose-dusty": "#D8B4A6",
                        "slate-luxe": "#2C2C2C"
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"],
                        "serif": ["Cormorant Garamond", "serif"],
                        "sans": ["Montserrat", "sans-serif"],
                        "playfair": ["Playfair Display", "serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            height: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e619a133;
            border-radius: 10px;
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .serif-heading {
            font-family: 'Cormorant Garamond', serif;
        }
        body {
            -webkit-tap-highlight-color: transparent;
        }
        
        /* Search overlay animation */
        .search-overlay {
            transition: opacity 0.3s ease;
        }
        
        .search-modal {
            transition: transform 0.3s ease;
        }
    </style>
</head>
<body class="bg-ivory text-slate-luxe font-sans antialiased min-h-screen">
   
    <!-- Main Navigation -->
    <nav class="bg-ivory/95 backdrop-blur-md sticky top-0 z-50 border-b border-rose-soft">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="text-2xl serif-heading font-light tracking-wider text-gold-deep hover:opacity-80 transition">
                        CHIC SCENTS
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-xs uppercase tracking-widest hover:text-gold-deep transition">Home</a>
                    <a href="{{ route('products.index') }}" class="text-xs uppercase tracking-widest hover:text-gold-deep transition">Products</a>
                    <a href="{{ route('brands.index') }}" class="text-xs uppercase tracking-widest hover:text-gold-deep transition">Brands</a>
                    <a href="/about" class="text-xs uppercase tracking-widest hover:text-gold-deep transition">Our Story</a>
                </div>

                <!-- Icons -->
                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <button class="p-2 hover:text-gold-deep transition" onclick="openSearchModal()">
                        <span class="material-symbols-outlined text-xl">search</span>
                    </button>
                    
                    
                    <!-- Cart -->
                    <a href="/cart" class="p-2 hover:text-gold-deep transition relative">
                        <span class="material-symbols-outlined text-xl">shopping_bag</span>
                        <span class="absolute -top-1 -right-1 bg-gold-deep text-white text-[9px] w-4 h-4 rounded-full flex items-center justify-center">0</span>
                    </a>

                    <!-- Mobile menu button -->
                    <button class="md:hidden p-2 hover:text-gold-deep transition" onclick="toggleMobileMenu()">
                        <span class="material-symbols-outlined text-xl">menu</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-rose-soft bg-ivory">
            <div class="px-4 py-4 space-y-3">
                <a href="{{ route('home') }}" class="block text-xs uppercase tracking-widest hover:text-gold-deep transition py-2">Home</a>
                <a href="{{ route('products.index') }}" class="block text-xs uppercase tracking-widest hover:text-gold-deep transition py-2">Products</a>
                <a href="{{ route('brands.index') }}" class="block text-xs uppercase tracking-widest hover:text-gold-deep transition py-2">Brands</a>
                <a href="/about" class="block text-xs uppercase tracking-widest hover:text-gold-deep transition py-2">Our Story</a>
            </div>
        </div>
    </nav>

    <!-- Search Modal -->
    <div id="searchOverlay" class="search-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-[100] opacity-0 pointer-events-none transition-opacity">
        <div class="min-h-screen px-4 flex items-start justify-center pt-24">
            <div id="searchModal" class="search-modal bg-ivory w-full max-w-2xl rounded-lg shadow-2xl transform -translate-y-full transition-transform">
                <!-- Search Header -->
                <div class="p-4 border-b border-rose-soft flex items-center justify-between">
                    <h3 class="text-sm uppercase tracking-widest text-gold-deep">Search Fragrances</h3>
                    <button onclick="closeSearchModal()" class="p-2 hover:text-gold-deep transition">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <!-- Search Input -->
                <div class="p-6">
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                            <span class="material-symbols-outlined text-xl">search</span>
                        </span>
                        <input 
                            type="text" 
                            id="searchInput"
                            placeholder="Search by perfume name, brand, or notes..." 
                            class="w-full pl-12 pr-4 py-4 border border-rose-soft rounded-full focus:border-gold-deep focus:ring-1 focus:ring-gold-deep outline-none transition"
                            autocomplete="off"
                            onkeyup="handleSearch(this.value)"
                        >
                        <button onclick="clearSearch()" id="clearSearchBtn" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-gold-deep transition hidden">
                            <span class="material-symbols-outlined text-lg">close</span>
                        </button>
                    </div>

                    <!-- Search Results -->
                    <div id="searchResults" class="mt-6 max-h-96 overflow-y-auto custom-scrollbar">
                        <!-- Results will be populated here -->
                        <div class="text-center text-slate-400 py-8">
                            <span class="material-symbols-outlined text-4xl mb-2">search</span>
                            <p class="text-sm">Type something to search for fragrances...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-rose-soft/20 border-t border-rose-soft">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-1">
                    <h3 class="text-xl serif-heading font-light text-gold-deep mb-4">CHIC SCENTS</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Luxury fragrances in every size. Discover your signature scent with our elegant decants and full bottles.
                    </p>
                </div>

                <!-- Shop -->
                <div>
                    <h4 class="text-xs uppercase tracking-widest font-semibold mb-4">Shop</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('products.index') }}" class="text-sm text-slate-500 hover:text-gold-deep transition">All Fragrances</a></li>
                        <li><a href="{{ route('products.index') }}?type=decant" class="text-sm text-slate-500 hover:text-gold-deep transition">Decants</a></li>
                        <li><a href="{{ route('products.index') }}?type=full" class="text-sm text-slate-500 hover:text-gold-deep transition">Full Bottles</a></li>
                        <li><a href="{{ route('products.index') }}?sort=newest" class="text-sm text-slate-500 hover:text-gold-deep transition">New Arrivals</a></li>
                        <li><a href="{{ route('products.index') }}?sort=bestsellers" class="text-sm text-slate-500 hover:text-gold-deep transition">Bestsellers</a></li>
                    </ul>
                </div>

                <!-- Info -->
                <div>
                    <h4 class="text-xs uppercase tracking-widest font-semibold mb-4">Information</h4>
                    <ul class="space-y-2">
                        <li><a href="/about" class="text-sm text-slate-500 hover:text-gold-deep transition">Our Story</a></li>
                        <li><a href="/contact" class="text-sm text-slate-500 hover:text-gold-deep transition">Contact Us</a></li>
                        <li><a href="/shipping" class="text-sm text-slate-500 hover:text-gold-deep transition">Shipping & Returns</a></li>
                        <li><a href="/faq" class="text-sm text-slate-500 hover:text-gold-deep transition">FAQ</a></li>
                        <li><a href="/privacy" class="text-sm text-slate-500 hover:text-gold-deep transition">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Connect -->
                <div>
                    <h4 class="text-xs uppercase tracking-widest font-semibold mb-4">Connect</h4>
                    <ul class="space-y-2">
                        <li><a href="https://www.instagram.com/chic_.scents" target="_blank" rel="noopener noreferrer" class="text-sm text-slate-500 hover:text-gold-deep transition">Instagram</a></li>
                        <li><a href="https://chat.whatsapp.com/H42ZcOwhr7F2WTGniVrnAF" target="_blank" rel="noopener noreferrer" class="text-sm text-slate-500 hover:text-gold-deep transition">WhatsApp</a></li>
                        <li><a href="https://www.tiktok.com/@chic_.scents" target="_blank" rel="noopener noreferrer" class="text-sm text-slate-500 hover:text-gold-deep transition">TikTok</a></li>
                    </ul>
                </div>
            </div>
            

            <!-- Bottom Bar -->
            <div class="border-t border-rose-soft mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-xs text-slate-400">
                    © {{ date('Y') }} Chic Scents. All rights reserved.
                </p>
                <p class="text-xs text-slate-400 mt-2 md:mt-0">
                    Luxury fragrances for the modern Kenyan
                </p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
        
        // Search Modal Functions
        function openSearchModal() {
            document.getElementById('searchOverlay').classList.remove('opacity-0', 'pointer-events-none');
            document.getElementById('searchModal').classList.remove('-translate-y-full');
            document.getElementById('searchInput').focus();
            
            // Add escape key listener
            document.addEventListener('keydown', handleEscapeKey);
        }
        
        function closeSearchModal() {
            document.getElementById('searchOverlay').classList.add('opacity-0', 'pointer-events-none');
            document.getElementById('searchModal').classList.add('-translate-y-full');
            document.getElementById('searchInput').value = '';
            document.getElementById('clearSearchBtn').classList.add('hidden');
            document.getElementById('searchResults').innerHTML = `
                <div class="text-center text-slate-400 py-8">
                    <span class="material-symbols-outlined text-4xl mb-2">search</span>
                    <p class="text-sm">Type something to search for fragrances...</p>
                </div>
            `;
            
            // Remove escape key listener
            document.removeEventListener('keydown', handleEscapeKey);
        }
        
        function handleEscapeKey(e) {
            if (e.key === 'Escape') {
                closeSearchModal();
            }
        }
        
        function clearSearch() {
            document.getElementById('searchInput').value = '';
            document.getElementById('clearSearchBtn').classList.add('hidden');
            document.getElementById('searchResults').innerHTML = `
                <div class="text-center text-slate-400 py-8">
                    <span class="material-symbols-outlined text-4xl mb-2">search</span>
                    <p class="text-sm">Type something to search for fragrances...</p>
                </div>
            `;
            document.getElementById('searchInput').focus();
        }
        
        function handleSearch(query) {
    const clearBtn = document.getElementById('clearSearchBtn');
    const resultsDiv = document.getElementById('searchResults');
    
    if (query.length > 0) {
        clearBtn.classList.remove('hidden');
        
        // Show loading state
        resultsDiv.innerHTML = `
            <div class="text-center text-slate-400 py-8">
                <span class="material-symbols-outlined text-4xl mb-2 animate-spin">progress_activity</span>
                <p class="text-sm">Searching...</p>
            </div>
        `;
        
        // Debounce search to avoid too many requests
        clearTimeout(window.searchTimeout);
        window.searchTimeout = setTimeout(() => {
            performSearch(query);
        }, 300);
    } else {
        clearBtn.classList.add('hidden');
        resultsDiv.innerHTML = `
            <div class="text-center text-slate-400 py-8">
                <span class="material-symbols-outlined text-4xl mb-2">search</span>
                <p class="text-sm">Type something to search for fragrances...</p>
            </div>
        `;
    }
}

function performSearch(query) {
    console.log('Searching for:', query);
    
    fetch(`/search?q=${encodeURIComponent(query)}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(data => {
        console.log('Search results:', data);
        if (data.error) {
            throw new Error(data.error);
        }
        displaySearchResults(data);
    })
    .catch(error => {
        console.error('Search error:', error);
        let errorMessage = 'An error occurred. Please try again.';
        
        if (error.message) {
            errorMessage = error.message;
        }
        
        document.getElementById('searchResults').innerHTML = `
            <div class="text-center text-red-500 py-8">
                <span class="material-symbols-outlined text-4xl mb-2">error</span>
                <p class="text-sm">${errorMessage}</p>
            </div>
        `;
    });
}
        
        function displaySearchResults(results) {
    const resultsDiv = document.getElementById('searchResults');
    
    if (results.length === 0) {
        resultsDiv.innerHTML = `
            <div class="text-center text-slate-400 py-8">
                <span class="material-symbols-outlined text-4xl mb-2">search_off</span>
                <p class="text-sm">No perfumes found matching your search.</p>
            </div>
        `;
        return;
    }
    
    let html = '<div class="space-y-4">';
    results.forEach(perfume => {
        // Safely format prices
        const fullPrice = formatPrice(perfume.price);
        const decantPrice = perfume.decant_price ? formatPrice(perfume.decant_price) : null;
        
        // Safely get image URL
        const imageUrl = perfume.featured_image || '';
        
        // Safely get brand name
        const brandName = perfume.brand && perfume.brand.name ? perfume.brand.name : '';
        
        html += `
            <a href="/products/${perfume.slug}" onclick="closeSearchModal()" class="flex items-center gap-4 p-4 hover:bg-rose-soft/20 rounded-lg transition group">
                <div class="w-16 h-16 bg-ivory rounded-sm overflow-hidden flex-shrink-0">
                    ${imageUrl ? 
                        `<img src="${imageUrl}" alt="${escapeHtml(perfume.name)}" class="w-full h-full object-cover">` : 
                        `<div class="w-full h-full flex items-center justify-center"><span class="material-symbols-outlined text-slate-400">image</span></div>`
                    }
                </div>
                <div class="flex-1">
                    <h4 class="font-medium group-hover:text-gold-deep transition">${highlightText(escapeHtml(perfume.name), document.getElementById('searchInput').value)}</h4>
                    ${brandName ? `<p class="text-xs text-slate-500">${highlightText(escapeHtml(brandName), document.getElementById('searchInput').value)}</p>` : ''}
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-gold-deep text-sm">Kshs ${fullPrice}</span>
                        ${decantPrice ? `<span class="text-xs text-slate-400">| Decant: Kshs ${decantPrice}</span>` : ''}
                    </div>
                </div>
            </a>
        `;
    });
    html += '</div>';
    
    resultsDiv.innerHTML = html;
}

// Helper function to safely format prices
function formatPrice(price) {
    if (price === null || price === undefined) return '0.00';
    
    // Convert to number if it's a string
    let numPrice = typeof price === 'string' ? parseFloat(price) : price;
    
    // Check if it's a valid number
    if (isNaN(numPrice)) return '0.00';
    
    // Format with 2 decimal places and thousand separators
    return numPrice.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

// Helper function to escape HTML
function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
        
        function highlightText(text, query) {
            if (!query || !text) return text;
            const regex = new RegExp(`(${query})`, 'gi');
            return text.replace(regex, '<span class="bg-gold-deep/20 text-gold-deep">$1</span>');
        }
        
        // Close modal when clicking outside
        document.getElementById('searchOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSearchModal();
            }
        });
    </script>
    <!-- Floating Chat Widget -->
@include('laravel-chatbot::components.floating-chat')

    @stack('scripts')
</body>
</html>