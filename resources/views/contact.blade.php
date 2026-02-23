@extends('layouts.app')

@section('title', 'Contact Us | Chic Scents')

@section('content')
    <!-- Top Spacer -->
    <div class="h-11 w-full bg-ivory/90"></div>

    <main class="pb-32">
        <!-- Header -->
        <div class="px-8 py-16 bg-rose-soft/20 text-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gold-deep/20 to-transparent"></div>
            
            <span class="text-[10px] uppercase tracking-[0.5em] font-semibold text-gold-deep mb-4 block">
                Get In Touch
            </span>
            
            <h1 class="text-5xl md:text-6xl serif-heading font-light mb-6">
                Contact Us
            </h1>
            
            <p class="text-slate-500 max-w-2xl mx-auto">
                Have questions about our fragrances? Reach out to us on social media or give us a call.
            </p>

            <div class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gold-deep/20 to-transparent"></div>
        </div>

        <!-- Breadcrumb -->
        <div class="px-8 py-6 border-b border-rose-soft">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center gap-2 text-xs text-slate-400">
                    <a href="{{ route('home') }}" class="hover:text-gold-deep transition">Home</a>
                    <span>/</span>
                    <span class="text-gold-deep">Contact Us</span>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <section class="px-8 mt-16">
            <div class="max-w-4xl mx-auto">
                <!-- Online Shop Notice -->
                <div class="mb-12 p-8 bg-rose-soft/20 rounded-lg border border-rose-soft text-center">
                    <span class="material-symbols-outlined text-4xl text-gold-deep mb-3">store</span>
                    <h3 class="text-lg serif-heading font-light mb-2">Online Only Boutique</h3>
                    <p class="text-sm text-slate-600 max-w-xl mx-auto">
                        Chic Scents is an online-only boutique. While we don't have a physical store, 
                        we're always available on social media and phone to assist you with any questions 
                        about our fragrances.
                    </p>
                </div>
                
                <!-- Contact Methods Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Phone -->
                    <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition text-center group">
                        <div class="w-16 h-16 bg-rose-soft/30 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-gold-deep/20 transition">
                            <span class="material-symbols-outlined text-2xl text-gold-deep">call</span>
                        </div>
                        <h3 class="text-sm uppercase tracking-wider font-medium mb-2">Call or Text</h3>
                        <p class="text-slate-500 text-sm mb-3">Quick responses via call or text</p>
                        <a href="tel:+254716052342" class="text-gold-deep text-xl hover:underline">
                            +254 716 052 342
                        </a>
                    </div>

                    <!-- WhatsApp -->
                    <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition text-center group">
                        <div class="w-16 h-16 bg-rose-soft/30 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-gold-deep/20 transition">
                            <span class="material-symbols-outlined text-2xl text-gold-deep">chat</span>
                        </div>
                        <h3 class="text-sm uppercase tracking-wider font-medium mb-2">WhatsApp</h3>
                        <p class="text-slate-500 text-sm mb-3">Chat with us on WhatsApp</p>
                        <a href="https://wa.me/254716052342" target="_blank" class="text-gold-deep text-xl hover:underline">
                            +254 716 052 342
                        </a>
                    </div>

                    <!-- Instagram -->
                    <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition text-center group">
                        <div class="w-16 h-16 bg-rose-soft/30 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-gold-deep/20 transition">
                            <span class="material-symbols-outlined text-2xl text-gold-deep">photo_camera</span>
                        </div>
                        <h3 class="text-sm uppercase tracking-wider font-medium mb-2">Instagram</h3>
                        <p class="text-slate-500 text-sm mb-3">DM us on Instagram</p>
                        <a href="https://www.instagram.com/chic_.scents" target="_blank" class="text-gold-deep text-xl hover:underline">
                            @chic_.scents
                        </a>
                    </div>

                    <!-- TikTok -->
                    <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition text-center group">
                        <div class="w-16 h-16 bg-rose-soft/30 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-gold-deep/20 transition">
                            <span class="material-symbols-outlined text-2xl text-gold-deep">music_note</span>
                        </div>
                        <h3 class="text-sm uppercase tracking-wider font-medium mb-2">TikTok</h3>
                        <p class="text-slate-500 text-sm mb-3">Message us on TikTok</p>
                        <a href="https://www.tiktok.com/@chic_.scents" target="_blank" class="text-gold-deep text-xl hover:underline">
                            @chic_.scents
                        </a>
                    </div>
                </div>

               

                <!-- Response Time -->
                <div class="mt-12 text-center">
                    <div class="inline-flex items-center gap-2 px-6 py-3 bg-rose-soft/30 rounded-full">
                        <span class="material-symbols-outlined text-gold-deep text-sm">schedule</span>
                        <span class="text-sm text-slate-600">We typically respond within a few hours</span>
                    </div>
                    <p class="text-xs text-slate-400 mt-4">
                        Business Hours: Mon - Fri: 9am - 6pm | Sat: 10am - 4pm | Sun: Closed
                    </p>
                </div>
            </div>
        </section>

        <!-- FAQ Teaser -->
        <section class="px-8 mt-20">
            <div class="max-w-3xl mx-auto text-center">
                <span class="text-[10px] uppercase tracking-[0.3em] text-gold-deep mb-3 block">
                    Quick Answers
                </span>
                <h2 class="text-2xl serif-heading font-light mb-6">Frequently Asked Questions</h2>
                <p class="text-slate-500 mb-8">
                    Find quick answers to common questions about our fragrances, shipping, and returns.
                </p>
                <a href="/faq" class="inline-block text-gold-deep font-medium text-sm uppercase tracking-wider border-b border-gold-deep/40 pb-1">
                    Visit FAQ Page →
                </a>
            </div>
        </section>
    </main>
@endsection