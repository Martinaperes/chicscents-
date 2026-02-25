<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - ScentCepts</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background: #ffffff; 
        }

        .serif-heading { font-family: 'Playfair Display', serif; }

        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(173,126,108,0.4);
            border-radius: 20px;
        }
    </style>
</head>

<body class="text-slate-700 min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 h-screen sticky top-0 bg-white border-r border-[#f1e6e2] shadow-sm flex flex-col">

        <!-- Logo -->
        <div class="px-6 py-8 flex items-center gap-4 border-b border-[#f1e6e2]">
            <div class="w-10 h-10 rounded-xl bg-[#ad7e6c] flex items-center justify-center font-black text-white text-lg shadow">
                <img src="{{ asset('images/hero/chicsentslogo.jpg') }}" alt="ScentCepts Logo" class="w-full h-full object-contain">
            </div>
            <div>
                <h1 class="text-sm font-black uppercase tracking-tight text-slate-800">ScentCepts</h1>
                <p class="text-[10px] uppercase font-bold tracking-widest text-[#ad7e6c]">Management Hub</p>
            </div>
        </div>

        <!-- Navigation -->
        <div class="flex-1 py-8 px-4 space-y-1 overflow-y-auto custom-scrollbar">

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-5 py-3 rounded-xl text-sm font-semibold transition
               {{ request()->routeIs('admin.dashboard') 
                    ? 'text-[#ad7e6c] bg-[#f4eae6] border-l-4 border-[#ad7e6c]' 
                    : 'text-slate-600 hover:text-[#ad7e6c] hover:bg-[#f9f4f2]' }}">
                <span class="material-symbols-outlined text-lg">grid_view</span>
                Dashboard
            </a>

            <!-- Products -->
            <a href="{{ route('admin.products') }}"
               class="flex items-center gap-3 px-5 py-3 rounded-xl text-sm font-semibold transition
               {{ request()->routeIs('admin.products*') 
                    ? 'text-[#ad7e6c] bg-[#f4eae6] border-l-4 border-[#ad7e6c]' 
                    : 'text-slate-600 hover:text-[#ad7e6c] hover:bg-[#f9f4f2]' }}">
                <span class="material-symbols-outlined text-lg">inventory_2</span>
                Fragrances
            </a>

            <!-- Brands -->
            <a href="{{ route('admin.brands') }}"
               class="flex items-center gap-3 px-5 py-3 rounded-xl text-sm font-semibold transition
               {{ request()->routeIs('admin.brands*') 
                    ? 'text-[#ad7e6c] bg-[#f4eae6] border-l-4 border-[#ad7e6c]' 
                    : 'text-slate-600 hover:text-[#ad7e6c] hover:bg-[#f9f4f2]' }}">
                <span class="material-symbols-outlined text-lg">verified</span>
                Brands
            </a>

            <!-- Orders -->
            <a href="{{ route('admin.orders') }}"
               class="flex items-center gap-3 px-5 py-3 rounded-xl text-sm font-semibold transition
               {{ request()->routeIs('admin.orders*') 
                    ? 'text-[#ad7e6c] bg-[#f4eae6] border-l-4 border-[#ad7e6c]' 
                    : 'text-slate-600 hover:text-[#ad7e6c] hover:bg-[#f9f4f2]' }}">
                <span class="material-symbols-outlined text-lg">shopping_cart</span>
                Orders
            </a>



            <!-- Customers -->
            <a href="{{ route('admin.customers') }}"
               class="flex items-center gap-3 px-5 py-3 rounded-xl text-sm font-semibold transition
               {{ request()->routeIs('admin.customers*') 
                    ? 'text-[#ad7e6c] bg-[#f4eae6] border-l-4 border-[#ad7e6c]' 
                    : 'text-slate-600 hover:text-[#ad7e6c] hover:bg-[#f9f4f2]' }}">
                <span class="material-symbols-outlined text-lg">group</span>
                Customers
            </a>

        </div>

        <!-- User Section -->
        <div class="p-6 border-t border-[#f1e6e2] bg-[#faf7f6]">

            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-[#ad7e6c] text-white flex items-center justify-center font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-[#ad7e6c] uppercase font-bold">Admin</p>
                </div>
            </div>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
    class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl 
           border border-[#ad7e6c] text-[#ad7e6c] font-semibold text-sm
           hover:bg-[#ad7e6c] hover:text-white
           active:scale-[0.98]
           transition-all duration-200">
    
    <span class="material-symbols-outlined text-sm">logout</span>
    Logout
</button>
            </form>

        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col min-h-screen">

        <!-- TOP BAR -->
        <header class="h-16 bg-white border-b border-[#f1e6e2] flex items-center justify-between px-8 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800">
                @yield('page_title', 'Dashboard')
            </h2>

            <div class="flex items-center gap-4">

                <button class="px-4 py-2 rounded-xl text-sm font-semibold 
                               text-[#ad7e6c] bg-[#f4eae6] 
                               hover:bg-[#ad7e6c] hover:text-white transition">
                    Notifications
                </button>

                <button class="px-4 py-2 rounded-xl text-sm font-semibold 
                               text-[#ad7e6c] bg-[#f4eae6] 
                               hover:bg-[#ad7e6c] hover:text-white transition">
                    Help
                </button>

            </div>
        </header>

        <!-- CONTENT -->
        <main class="flex-1 p-10 bg-[#fcfaf9]">

            @if(session('success'))
                <div class="mb-6 p-4 bg-[#ad7e6c] text-white rounded-xl shadow">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-500 text-white rounded-xl shadow">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

        </main>

        <!-- FOOTER -->
        <footer class="p-6 border-t border-[#f1e6e2] bg-white text-center text-xs text-slate-400">
            © 2026 ScentCepts Admin Panel
        </footer>

    </div>

</body>
</html>