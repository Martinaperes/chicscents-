<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | ScentCepts</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    <style>
        .serif-heading { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-ivory text-slate-luxe font-sans antialiased min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full">
        <!-- Logo/Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl serif-heading tracking-[0.2em] uppercase font-light mb-2 text-slate-900">ScentCepts</h1>
            <p class="text-[10px] uppercase tracking-[0.4em] text-gold-deep">Administrator Portal</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white p-8 md:p-10 rounded-sm shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-rose-soft">
            <h2 class="text-xl serif-heading font-light mb-8 text-center text-slate-800">Please sign in</h2>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 text-red-600 text-xs border border-red-100 rounded-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-[10px] uppercase tracking-widest text-slate-400 mb-2">Email Address</label>
                    <input type="email" name="email" id="email" required 
                           class="w-full px-4 py-3 bg-ivory border border-rose-soft focus:border-gold-deep focus:ring-0 transition text-sm rounded-sm"
                           placeholder="admin@chicscents.com">
                </div>

                <div>
                    <label for="password" class="block text-[10px] uppercase tracking-widest text-slate-400 mb-2">Password</label>
                    <input type="password" name="password" id="password" required 
                           class="w-full px-4 py-3 bg-ivory border border-rose-soft focus:border-gold-deep focus:ring-0 transition text-sm rounded-sm"
                           placeholder="••••••••">
                </div>

                <div class="pt-2">
                    <button type="submit" 
                            class="w-full bg-slate-luxe text-ivory py-4 rounded-sm text-[10px] uppercase tracking-[0.2em] hover:bg-gold-deep transition duration-500 font-medium">
                        Enter Dashboard
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer Note -->
        <p class="mt-8 text-center text-[10px] text-slate-400 uppercase tracking-widest">
            &copy; {{ date('Y') }} ScentCepts Kenya. Secure Environment.
        </p>
    </div>
</body>
</html>