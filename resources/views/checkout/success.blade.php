@extends('layouts.app')

@section('title', 'Order Confirmed | Chic Scents')

@section('content')
<main class="pb-16 md:pb-32">
    <!-- Success Section -->
    <section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <!-- Success Icon -->
            <div class="w-20 h-20 md:w-24 md:h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined text-4xl md:text-5xl text-green-600">check_circle</span>
            </div>
            
            <h1 class="text-3xl md:text-4xl serif-heading font-light mb-4">
                Thank You for Your <span class="italic text-gold-deep">Order!</span>
            </h1>
            
            <p class="text-sm md:text-base text-slate-600 mb-8 max-w-md mx-auto">
                We've received your order and will send you a confirmation SMS shortly. 
                You'll receive another SMS when your order ships.
            </p>
            
            <div class="bg-rose-soft/20 rounded-sm p-6 mb-8 text-left">
                <h2 class="text-sm font-medium mb-3">What happens next?</h2>
                <ul class="space-y-3 text-sm text-slate-600">
                    <li class="flex items-start gap-2">
                        <span class="text-gold-deep">1.</span>
                        <span>Order confirmation SMS sent to your phone</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-gold-deep">2.</span>
                        <span>We prepare your items for shipping</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-gold-deep">3.</span>
                        <span>You receive tracking information once order ships</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-gold-deep">4.</span>
                        <span>Delivery to your doorstep or selected pickup point</span>
                    </li>
                </ul>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" class="bg-gold-deep text-white px-8 py-3 rounded-full text-xs tracking-widest uppercase hover:opacity-90 transition">
                    Continue Shopping
                </a>
                <a href="#" class="border border-gold-deep text-gold-deep px-8 py-3 rounded-full text-xs tracking-widest uppercase hover:bg-gold-deep hover:text-white transition">
                    Track Order
                </a>
            </div>
            
            <!-- Contact Support -->
            <p class="text-xs text-slate-400 mt-8">
                Questions about your order? <a href="https://wa.me/254716052342" class="text-gold-deep underline">WhatsApp us</a>
            </p>
        </div>
    </section>
</main>
@endsection