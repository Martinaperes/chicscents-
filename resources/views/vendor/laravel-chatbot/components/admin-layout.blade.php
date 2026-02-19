<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS via CDN (only if not already loaded) -->
        @unless(config('laravel-chatbot.skip_tailwind_cdn', false))
            <script src="https://cdn.tailwindcss.com"></script>
            <script>
                tailwind.config = {
                    darkMode: 'class',
                }
            </script>
        @endunless
        
        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <div class="flex">
                <!-- Sidebar Menu -->
                <aside class="w-64 bg-white dark:bg-gray-800 min-h-screen border-r border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col h-full">
                        <!-- Logo/Brand -->
                        <div class="flex items-center justify-center h-16 bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
                            <h1 class="text-xl font-bold text-gray-900 dark:text-white">{{ config('app.name', 'Laravel') }}</h1>
                        </div>

                        <!-- Navigation -->
                        <nav class="flex-1 px-4 py-4 space-y-2">
                            @if(Route::has('dashboard'))
                                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white transition">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Dashboard
                                </a>
                            @endif

                            <div class="pt-4">
                                <p class="px-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Chatbot</p>
                            </div>

                            <a href="{{ route('bot-questions.index') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white transition {{ request()->routeIs('bot-questions.*') && !request()->routeIs('bot-questions.create') && !request()->routeIs('bot-questions.import') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 border-l-4 border-blue-500' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                </svg>
                                All Questions
                            </a>

                            <a href="{{ route('bot-questions.create') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white transition {{ request()->routeIs('bot-questions.create') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 border-l-4 border-blue-500' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Create Question
                            </a>

                            <a href="{{ route('bot-questions.import') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white transition {{ request()->routeIs('bot-questions.import') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 border-l-4 border-blue-500' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                Import Questions
                            </a>

                            <a href="{{ url('chatbot') }}" target="_blank" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white transition">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                Test Chatbot
                            </a>

                            @if(Route::has('profile.edit'))
                                <div class="pt-4">
                                    <p class="px-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Account</p>
                                </div>

                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white transition">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profile
                                </a>
                            @endif
                        </nav>

                        <!-- User Info (if authenticated) -->
                        @auth
                            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center">
                                            <span class="text-sm font-medium text-white">{{ substr(auth()->user()?->name ?? 'U', 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()?->name ?? 'User' }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()?->email ?? '' }}</p>
                                    </div>
                                </div>
                                @if(Route::has('logout'))
                                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white transition">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            Logout
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endauth
                    </div>
                </aside>

                <!-- Main Content -->
                <div class="flex-1">
                    <!-- Top Navigation Bar -->
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="flex justify-between items-center h-16">
                                <div>
                                    @isset($header)
                                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                                            {{ $header }}
                                        </h2>
                                    @else
                                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                                            Admin Panel
                                        </h2>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </header>

                    <!-- Page Content -->
                    <main class="p-6">
                        @if(session('success'))
                            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif

                        @if(isset($errors) && $errors->any())
                            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <ul class="list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
        
        @stack('scripts')
    </body>
</html>

