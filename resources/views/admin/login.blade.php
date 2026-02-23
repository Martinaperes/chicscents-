<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChicScents Admin Login</title>

    <!-- Tailwind CSS + Plugins -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Google Fonts (Material Icons) -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Tailwind Configuration -->
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#e61980",
                        "background-light": "#f8f6f7",
                        "background-dark": "#211119",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        };
    </script>

    <!-- Custom Styles -->
    <style>
        .premium-blur {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .input-underline {
            border: none;
            border-bottom: 1px solid rgba(230, 25, 128, 0.2);
            background: transparent !important;
            padding-left: 0;
            padding-right: 0;
            border-radius: 0;
        }
        .input-underline:focus {
            border-bottom: 2px solid #e61980;
            box-shadow: none !important;
            outline: none !important;
        }
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased h-screen overflow-hidden">

<div class="relative flex h-full w-full flex-col items-center justify-between p-8 pt-24 pb-12">

    <!-- Background Decorative Elements -->
    <div class="absolute inset-0 z-0 opacity-20 pointer-events-none overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary/20 rounded-full blur-[100px]"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-primary/10 rounded-full blur-[100px]"></div>
    </div>

    <!-- Header / Logo Section -->
    <div class="z-10 flex flex-col items-center text-center space-y-4">
        <div class="flex items-center justify-center w-20 h-20 rounded-full bg-slate-100/5 dark:bg-slate-800/50 border border-slate-200/10 mb-2">
            <span class="material-symbols-outlined text-primary text-4xl" style="font-variation-settings: 'FILL' 1">
                diamond
            </span>
        </div>
        <h1 class="text-3xl font-light tracking-[0.25em] uppercase text-slate-900 dark:text-white">
            ChicScents
        </h1>
        <p class="text-xs tracking-[0.4em] uppercase text-slate-500 dark:text-slate-400 font-medium">
            Administrative Portal
        </p>
    </div>

    <!-- Login Form Section -->
    <div class="z-10 w-full max-w-sm space-y-12">
        {{-- Update the action URL to match your login endpoint --}}
        <form method="POST" action="{{ url('/admin/login') }}" class="space-y-8">
            @csrf

            <!-- Email Field -->
            <div class="flex flex-col group">
                <label class="text-[10px] uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500 font-semibold mb-1">
                    Email Address
                </label>
                <input type="email" name="email" value="{{ old('email') }}" 
                       class="input-underline w-full py-3 text-lg font-light text-slate-800 dark:text-slate-100 placeholder:text-slate-300 dark:placeholder:text-slate-700 focus:placeholder-transparent transition-all" 
                       placeholder="admin@chicscents.com" required autofocus>
            </div>

            <!-- Password Field -->
            <div class="flex flex-col group relative">
                <label class="text-[10px] uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500 font-semibold mb-1">
                    Security Key
                </label>
                <div class="relative flex items-center">
                    <input type="password" name="password" 
                           class="input-underline w-full py-3 text-lg font-light text-slate-800 dark:text-slate-100 placeholder:text-slate-300 dark:placeholder:text-slate-700 focus:placeholder-transparent transition-all" 
                           placeholder="••••••••" required>
                    <button type="button" class="absolute right-0 text-slate-400 hover:text-primary transition-colors" onclick="togglePasswordVisibility(this)">
                        <span class="material-symbols-outlined text-xl">visibility</span>
                    </button>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col space-y-6 items-center">
                <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-medium py-4 rounded-lg tracking-[0.15em] uppercase text-sm transition-all shadow-xl shadow-primary/20 active:scale-[0.98]">
                    Sign In
                </button>
                {{-- Update the forgot password link to your actual route --}}
                <a href="{{ url('/admin/password/reset') }}" class="text-[11px] uppercase tracking-[0.1em] text-slate-400 dark:text-slate-500 hover:text-primary transition-colors">
                    Forgot Access Credentials?
                </a>
            </div>
        </form>
    </div>

    <!-- Footer / Security Section -->
    <div class="z-10 flex flex-col items-center space-y-6 w-full">
        <div class="flex items-center space-x-8">
            <div class="p-3 rounded-full border border-slate-200/10 dark:bg-slate-800/30 text-slate-400 hover:text-primary transition-all cursor-pointer">
                <span class="material-symbols-outlined text-2xl">fingerprint</span>
            </div>
            <div class="p-3 rounded-full border border-slate-200/10 dark:bg-slate-800/30 text-slate-400 hover:text-primary transition-all cursor-pointer">
                <span class="material-symbols-outlined text-2xl">face_6</span>
            </div>
        </div>
        <div class="flex flex-col items-center space-y-1">
            <div class="flex items-center space-x-2 text-slate-400 dark:text-slate-600">
                <span class="material-symbols-outlined text-xs">lock</span>
                <p class="text-[10px] uppercase tracking-widest font-bold">Encrypted Connection</p>
            </div>
            <p class="text-[9px] text-slate-400/50 dark:text-slate-600/50">v4.2.0-secure.chicscents</p>
        </div>
    </div>
</div>

<!-- Hidden Hero Image for Context (Background Reference) -->
<div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
    <div class="w-full h-full bg-center bg-cover scale-110 opacity-5 blur-sm"
         style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCpV0LMLrY_mXrkM_9fog9OoLHrh853FCn6tLPpxOlJs9gd1xRM1o78Y2i_9likJzejcRO8qdt46xJGuSEgPseS88W_wOiJuxx_iTDm5TznnSsh9yh9ZJUGbWv1gdKQ57c9lIol5XphAhAXCJxqc6SCanH1cMmxG9yTVJxW9o4PPJkc_XsPMjHEmL_ZD6OuUQlfKZ0FdyrMMcLKkvsSho2QoH-AQ_-fsYkP6RLX_RPhCl8BdNaBrgydBNM7yfvs8TN2YMCL17CjnMSb')">
    </div>
</div>

<!-- Simple JavaScript for password visibility toggle -->
<script>
    function togglePasswordVisibility(button) {
        const input = button.previousElementSibling; // the input field
        const icon = button.querySelector('.material-symbols-outlined');
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    }
</script>

</body>
</html>