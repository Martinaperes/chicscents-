@extends('layouts.app')

@section('title', 'Our Story | Chic Scents')

@section('content')
<main class="pb-32">
    <!-- Hero Section -->
    <section class="relative h-[50vh] min-h-[400px] overflow-hidden">
        <img 
            src="{{ asset('images/hero/decants.jpg') }}"
            alt="Luxury perfume bottles"
            class="absolute inset-0 w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="absolute inset-0 flex items-center justify-center text-center text-white">
            <div>
                <span class="text-[11px] uppercase tracking-[0.5em] font-medium text-gold-deep mb-4 block">
                    Our Story
                </span>
                <h1 class="text-5xl md:text-7xl serif-heading font-light mb-6">
                    The Art of <span class="italic text-gold-deep">Fragrance</span>
                </h1>
            </div>
        </div>
    </section>

    <!-- Mission Statement -->
    <section class="py-20 px-8">
        <div class="max-w-4xl mx-auto text-center">
            <span class="text-[10px] uppercase tracking-[0.3em] text-gold-deep font-semibold mb-4 block">Our Philosophy</span>
            <h2 class="text-3xl md:text-4xl serif-heading font-light mb-8 leading-tight">
                Making Luxury Accessible <br/>to Every Kenyan
            </h2>
            <p class="text-slate-600 leading-relaxed text-lg">
                At Chic Scents, we believe that luxury fragrances shouldn't be a luxury reserved for the few. 
                We're on a mission to bring world-class perfumes to Kenya, making them accessible through our 
                innovative decant system. Try before you commit, and find your signature scent without breaking the bank.
            </p>
        </div>
    </section>

    <!-- Divider -->
    <x-divider />

    <!-- Our Story Section -->
    <section class="py-20 px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="text-[10px] uppercase tracking-[0.3em] text-gold-deep font-semibold mb-4 block">How We Started</span>
                    <h2 class="text-3xl md:text-4xl serif-heading font-light mb-6">A Passion for <span class="italic text-gold-deep">Scent</span></h2>
                    <p class="text-slate-600 leading-relaxed mb-6">
                        Chic Scents was born from a simple observation: perfume lovers in Kenya deserved better. 
                        We saw how difficult it was to access authentic luxury fragrances, and how expensive it was 
                        to commit to a full bottle without ever smelling it first.
                    </p>
                    <p class="text-slate-600 leading-relaxed mb-6">
                        That's why we created our decant program. Now, you can explore a curated selection of the 
                        world's finest perfumes in elegant 10ml samples. Find what truly speaks to you, then invest 
                        in a full bottle of the ones you can't live without.
                    </p>
                    <p class="text-slate-600 leading-relaxed">
                        Today, we're proud to serve fragrance lovers across Kenya, helping them discover scents that 
                        express their unique personality and style.
                    </p>
                </div>
                <div class="relative">
                    <div class="aspect-[4/5] bg-rose-soft rounded-sm overflow-hidden">
                        <img 
                            src="https://images.unsplash.com/photo-1594035910387-fea47794261f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1887&q=80" 
                            alt="Perfume collection"
                            class="w-full h-full object-cover"
                        />
                    </div>
                    <!-- Decorative element -->
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 border border-gold-deep/20 rounded-sm -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <x-divider />

    <!-- Values Section -->
    <section class="py-20 px-8 bg-rose-soft/20">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-[10px] uppercase tracking-[0.3em] text-gold-deep font-semibold mb-4 block">What We Stand For</span>
                <h2 class="text-3xl md:text-4xl serif-heading font-light">Our Values</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Value 1 -->
                <div class="text-center p-8">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gold-deep/10 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-3xl text-gold-deep">verified</span>
                    </div>
                    <h3 class="text-xl serif-heading font-medium mb-3">Authenticity</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Every perfume we sell is 100% authentic, sourced directly from authorized distributors and brand houses.
                    </p>
                </div>

                <!-- Value 2 -->
                <div class="text-center p-8">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gold-deep/10 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-3xl text-gold-deep">handshake</span>
                    </div>
                    <h3 class="text-xl serif-heading font-medium mb-3">Accessibility</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Our decant program makes luxury affordable. Try before you invest in a full bottle.
                    </p>
                </div>

                <!-- Value 3 -->
                <div class="text-center p-8">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gold-deep/10 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-3xl text-gold-deep">diversity_3</span>
                    </div>
                    <h3 class="text-xl serif-heading font-medium mb-3">Community</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        We're building a community of fragrance lovers who share reviews, recommendations, and discoveries.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <x-divider />

    <!-- How It Works Section -->
    <section class="py-20 px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-[10px] uppercase tracking-[0.3em] text-gold-deep font-semibold mb-4 block">Simple Process</span>
                <h2 class="text-3xl md:text-4xl serif-heading font-light">How It <span class="italic text-gold-deep">Works</span></h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="relative text-center">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gold-deep text-white rounded-full flex items-center justify-center text-2xl font-light">1</div>
                    <h3 class="text-xl serif-heading font-medium mb-3">Explore</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Browse our curated collection of luxury fragrances from around the world.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="relative text-center">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gold-deep text-white rounded-full flex items-center justify-center text-2xl font-light">2</div>
                    <h3 class="text-xl serif-heading font-medium mb-3">Sample</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Order decants of the scents that intrigue you. Experience them in your own time.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="relative text-center">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gold-deep text-white rounded-full flex items-center justify-center text-2xl font-light">3</div>
                    <h3 class="text-xl serif-heading font-medium mb-3">Commit</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Found your signature scent? Invest in a full bottle with confidence.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <x-divider />

    <!-- WhatsApp Community Section -->
    <section class="py-20 px-8">
        <div class="max-w-4xl mx-auto text-center">
            <span class="text-[10px] uppercase tracking-[0.3em] text-gold-deep font-semibold mb-4 block">Join Our Community</span>
            <h2 class="text-3xl md:text-4xl serif-heading font-light mb-6">Connect on <span class="italic text-gold-deep">WhatsApp</span></h2>
            <p class="text-slate-600 max-w-2xl mx-auto mb-10 leading-relaxed">
                Be the first to know about new arrivals, exclusive offers, and fragrance tips. 
                Join our WhatsApp community to connect with fellow fragrance enthusiasts!
            </p>
            <a href="https://chat.whatsapp.com/H42ZcOwhr7F2WTGniVrnAF" 
               target="_blank"
               rel="noopener noreferrer"
               class="inline-flex items-center gap-3 bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-full text-sm font-medium tracking-wider uppercase transition-all duration-300 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                    <path d="M12 2C6.48 2 2 6.48 2 12c0 2.13.67 4.1 1.8 5.72L2.3 21.7l3.98-1.5C8.1 21.2 9.98 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm0 18c-1.87 0-3.63-.6-5.07-1.62L6 19.5l1.42-1.07C8.73 17.6 10.3 17 12 17c3.87 0 7-3.13 7-7s-3.13-7-7-7-7 3.13-7 7c0 1.48.46 2.86 1.25 4L5 16l1.5-.5c.95.58 2.05.93 3.25 1.02.43.56.95 1.04 1.55 1.42.81.52 1.74.88 2.73 1.06.4.07.82.1 1.25.1 1.57 0 3.07-.46 4.33-1.27l1.43 1.42C17.07 20.74 14.66 22 12 22z"/>
                </svg>
                Join WhatsApp Community
            </a>
        </div>
    </section>

    <!-- Divider -->
    <x-divider />

    <!-- Contact Info -->
<section class="py-20 px-8">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <span class="text-[10px] uppercase tracking-[0.3em] text-gold-deep font-semibold mb-4 block">Get In Touch</span>
            <h2 class="text-3xl md:text-4xl serif-heading font-light">Connect With <span class="italic text-gold-deep">Us</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- WhatsApp Community -->
            <div class="text-center">
                <div class="w-12 h-12 mx-auto mb-4 bg-green-500 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12c0 2.13.67 4.1 1.8 5.72L2.3 21.7l3.98-1.5C8.1 21.2 9.98 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-medium mb-2">WhatsApp Community</h3>
                <a href="https://chat.whatsapp.com/H42ZcOwhr7F2WTGniVrnAF" 
                   target="_blank" 
                   class="text-slate-500 hover:text-green-600 transition">
                    Join Group
                </a>
            </div>

            <!-- Instagram -->
            <div class="text-center">
                <div class="w-12 h-12 mx-auto mb-4 bg-rose-soft rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-gold-deep">photo_camera</span>
                </div>
                <h3 class="text-sm font-medium mb-2">Instagram</h3>
                <a href="https://www.instagram.com/chic_.scents" 
                   target="_blank" 
                   class="text-slate-500 hover:text-gold-deep transition">
                    @chic_.scents
                </a>
            </div>

            <!-- TikTok -->
            <div class="text-center">
                <div class="w-12 h-12 mx-auto mb-4 bg-rose-soft rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-gold-deep">music_note</span>
                </div>
                <h3 class="text-sm font-medium mb-2">TikTok</h3>
                <a href="https://www.tiktok.com/@chic_.scents" 
                   target="_blank" 
                   class="text-slate-500 hover:text-gold-deep transition">
                    @chic_.scents
                </a>
            </div>
        </div>
    </div>
</section>
</main>
@endsection