@extends('layouts.app')

@section('title', 'Shipping & Returns | ScentCepts')

@section('content')
<main class="pb-16 md:pb-32">
    <!-- Hero Section -->
    <section class="relative h-[30vh] md:h-[40vh] min-h-[200px] md:min-h-[300px] overflow-hidden">
        <img 
            src="https://images.unsplash.com/photo-1607344645866-009c320b63e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
            alt="Shipping and packaging"
            class="absolute inset-0 w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="absolute inset-0 flex items-center justify-center text-center text-white px-4">
            <div>
                <span class="text-[10px] md:text-[11px] uppercase tracking-[0.3em] md:tracking-[0.5em] font-medium text-gold-deep mb-3 md:mb-4 block">
                    Customer Care
                </span>
                <h1 class="text-3xl md:text-5xl lg:text-7xl serif-heading font-light mb-3 md:mb-6">
                    Shipping & <span class="italic text-gold-deep">Returns</span>
                </h1>
                <p class="text-xs md:text-sm lg:text-base max-w-2xl mx-auto font-light text-gray-200">
                    Everything you need to know about delivery and returns
                </p>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <x-divider />

    <!-- Shipping Information -->
    <section class="py-12 md:py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Section Intro -->
            <div class="text-center mb-12 md:mb-16">
                <span class="text-[8px] md:text-[10px] uppercase tracking-[0.2em] md:tracking-[0.3em] text-gold-deep font-semibold mb-3 md:mb-4 block">
                    Delivery Information
                </span>
                <h2 class="text-2xl md:text-3xl lg:text-4xl serif-heading font-light mb-4 md:mb-6">
                    We Deliver <span class="italic text-gold-deep">Everywhere</span>
                </h2>
                <p class="text-xs md:text-sm text-slate-500">
                    ScentCepts ships throughout Kenya. Here's how it works.
                </p>
            </div>

            <!-- Delivery Options -->
            <div class="space-y-8 md:space-y-12">
                <!-- Doorstep Delivery -->
                <div class="bg-white rounded-sm shadow-[0_5px_20px_rgba(0,0,0,0.02)] p-6 md:p-8">
                    <div class="flex items-start gap-4 md:gap-6">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-gold-deep/10 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-xl md:text-2xl text-gold-deep">home</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg md:text-xl font-medium mb-2">Doorstep Delivery</h3>
                            <div class="space-y-3 text-xs md:text-sm text-slate-600">
                                <p>We deliver directly to your home or office anywhere in Kenya.</p>
                                <p><span class="font-medium">Delivery time:</span> 1-5 business days depending on your location</p>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pick Up Mtaani Agent -->
                <div class="bg-white rounded-sm shadow-[0_5px_20px_rgba(0,0,0,0.02)] p-6 md:p-8">
                    <div class="flex items-start gap-4 md:gap-6">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-gold-deep/10 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-xl md:text-2xl text-gold-deep">location_on</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg md:text-xl font-medium mb-2">Pick Up Mtaani Agent</h3>
                            <div class="space-y-3 text-xs md:text-sm text-slate-600">
                                <p>Pick up your order from a convenient Pick Up Mtaani agent near you.</p>
                                <p><span class="font-medium">How it works:</span></p>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Select "Pick Up Mtaani Agent" at checkout</li>
                                    <li>Choose your nearest agent location</li>
                                    <li>Receive SMS when your order arrives</li>
                                    <li>Pick up at your convenience within 3 days</li>
                                </ul>
                                <p class="text-gold-deep font-medium mt-2">Free pickup at all Pick Up Mtaani agents</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Same Day Delivery (Nairobi) -->
                <div class="bg-white rounded-sm shadow-[0_5px_20px_rgba(0,0,0,0.02)] p-6 md:p-8">
                    <div class="flex items-start gap-4 md:gap-6">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-gold-deep/10 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-xl md:text-2xl text-gold-deep">flash_on</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg md:text-xl font-medium mb-2">Same Day Delivery (Nairobi)</h3>
                            <div class="space-y-3 text-xs md:text-sm text-slate-600">
                                <p>For customers within Nairobi, we offer same-day delivery on orders placed before 12noon.</p>
                                <p>Available for both doorstep delivery and Pick Up Mtaani agent pickup.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delivery Notes -->
            <div class="mt-12 p-6 bg-rose-soft/20 rounded-sm">
                <h4 class="text-sm font-medium mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gold-deep text-lg">info</span>
                    Important Delivery Information
                </h4>
                <ul class="space-y-2 text-xs md:text-sm text-slate-600 list-disc pl-6">
                    <li>Orders placed before 12noon are processed the same business day</li>
                    <li>Weekend orders are processed on the following Monday</li>
                    <li>You'll receive tracking information via SMS once your order ships</li>
                    <li>For doorstep delivery, a signature may be required upon delivery</li>
                    <li>For Pick Up Mtaani, you have 3 days to pick up your order</li>
                    <li>You'll receive an SMS when your order is ready for pickup</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <x-divider />

    <!-- Returns & Refunds -->
    <section class="py-12 md:py-20 px-4 sm:px-6 lg:px-8 bg-rose-soft/10">
        <div class="max-w-4xl mx-auto">
            <!-- Section Intro -->
            <div class="text-center mb-12 md:mb-16">
                <span class="text-[8px] md:text-[10px] uppercase tracking-[0.2em] md:tracking-[0.3em] text-gold-deep font-semibold mb-3 md:mb-4 block">
                    Peace of Mind
                </span>
                <h2 class="text-2xl md:text-3xl lg:text-4xl serif-heading font-light mb-4 md:mb-6">
                    Returns & <span class="italic text-gold-deep">Refunds</span>
                </h2>
                <p class="text-xs md:text-sm text-slate-500">
                    We want you to love your fragrance. If something's not right, we're here to help.
                </p>
            </div>

            <!-- Returns Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                <!-- Defective Items -->
                <div class="bg-white p-6 rounded-sm">
                    <div class="w-12 h-12 bg-gold-deep/10 rounded-full flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-2xl text-gold-deep">verified</span>
                    </div>
                    <h3 class="text-lg font-medium mb-3">Defective or Damaged Items</h3>
                    <p class="text-sm text-slate-600 mb-4">
                        Received a damaged or defective item? Contact us within 48 hours with photos for a replacement or refund.
                    </p>
                    <p class="text-xs text-slate-400">We'll arrange pickup and cover all return costs for damaged items</p>
                </div>

                <!-- Wrong Item -->
                <div class="bg-white p-6 rounded-sm">
                    <div class="w-12 h-12 bg-gold-deep/10 rounded-full flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-2xl text-gold-deep">sync_alt</span>
                    </div>
                    <h3 class="text-lg font-medium mb-3">Wrong Item Received</h3>
                    <p class="text-sm text-slate-600 mb-4">
                        If we sent the wrong fragrance, we'll arrange pickup and send the correct one immediately at no cost to you.
                    </p>
                </div>
            </div>

            <!-- Refund Process -->
            <div class="mt-12">
                <h3 class="text-xl font-medium mb-6 text-center">Refund Process</h3>
                <div class="flex flex-col md:flex-row justify-between gap-4 md:gap-0 relative">
                    <!-- Step 1 -->
                    <div class="flex-1 text-center relative">
                        <div class="w-10 h-10 bg-gold-deep text-white rounded-full flex items-center justify-center mx-auto mb-3 relative z-10">1</div>
                        <h4 class="text-sm font-medium mb-2">Contact Us</h4>
                        <p class="text-xs text-slate-500">Via WhatsApp within 48 hours of delivery</p>
                    </div>
                    
                    <!-- Arrow (hidden on mobile) -->
                    <div class="hidden md:block absolute top-4 left-[45%] text-gold-deep/30">→</div>
                    
                    <!-- Step 2 -->
                    <div class="flex-1 text-center relative">
                        <div class="w-10 h-10 bg-gold-deep text-white rounded-full flex items-center justify-center mx-auto mb-3 relative z-10">2</div>
                        <h4 class="text-sm font-medium mb-2">Provide Details</h4>
                        <p class="text-xs text-slate-500">Share photos of damage or wrong item</p>
                    </div>
                    
                    <!-- Arrow (hidden on mobile) -->
                    <div class="hidden md:block absolute top-4 right-[45%] text-gold-deep/30">→</div>
                    
                    <!-- Step 3 -->
                    <div class="flex-1 text-center">
                        <div class="w-10 h-10 bg-gold-deep text-white rounded-full flex items-center justify-center mx-auto mb-3 relative z-10">3</div>
                        <h4 class="text-sm font-medium mb-2">Return Arranged</h4>
                        <p class="text-xs text-slate-500">We schedule pickup at no cost to you</p>
                    </div>
                    
                    <!-- Step 4 -->
                    <div class="flex-1 text-center">
                        <div class="w-10 h-10 bg-gold-deep text-white rounded-full flex items-center justify-center mx-auto mb-3 relative z-10">4</div>
                        <h4 class="text-sm font-medium mb-2">Refund Issued</h4>
                        <p class="text-xs text-slate-500">To original payment method (3-5 days)</p>
                    </div>
                </div>
            </div>

            <!-- Non-Returnable Items -->
            <div class="mt-12 p-6 bg-white/50 rounded-sm border border-rose-soft">
                <h4 class="text-sm font-medium mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gold-deep text-lg">block</span>
                    Non-Returnable Items
                </h4>
                <p class="text-xs md:text-sm text-slate-600">
                    For hygiene reasons, we cannot accept returns on:
                </p>
                <ul class="mt-2 space-y-1 text-xs md:text-sm text-slate-500 list-disc pl-6">
                    <li>Opened or used fragrances</li>
                    <li>Decants that have been opened</li>
                    <li>Items without original packaging</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <x-divider />

    <!-- FAQ Section -->
    <section class="py-12 md:py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10 md:mb-12">
                <span class="text-[8px] md:text-[10px] uppercase tracking-[0.2em] md:tracking-[0.3em] text-gold-deep font-semibold mb-3 md:mb-4 block">
                    Common Questions
                </span>
                <h2 class="text-2xl md:text-3xl lg:text-4xl serif-heading font-light mb-4">
                    Shipping & Returns <span class="italic text-gold-deep">FAQ</span>
                </h2>
            </div>

            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="border border-rose-soft rounded-sm overflow-hidden">
                    <button class="w-full text-left p-4 md:p-6 flex justify-between items-center hover:bg-rose-soft/10 transition" onclick="toggleFAQ(this)">
                        <span class="text-sm md:text-base font-medium">How long does delivery take?</span>
                        <span class="material-symbols-outlined text-gold-deep transition-transform">expand_more</span>
                    </button>
                    <div class="hidden p-4 md:p-6 pt-0 text-xs md:text-sm text-slate-600 border-t border-rose-soft">
                        Delivery times vary by location: Nairobi (1-2 days for doorstep, same day for orders before 12noon), Upcountry (2-5 days). Pick Up Mtaani agents typically receive orders within 1-3 days.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="border border-rose-soft rounded-sm overflow-hidden">
                    <button class="w-full text-left p-4 md:p-6 flex justify-between items-center hover:bg-rose-soft/10 transition" onclick="toggleFAQ(this)">
                        <span class="text-sm md:text-base font-medium">How do I find a Pick Up Mtaani agent near me?</span>
                        <span class="material-symbols-outlined text-gold-deep transition-transform">expand_more</span>
                    </button>
                    <div class="hidden p-4 md:p-6 pt-0 text-xs md:text-sm text-slate-600 border-t border-rose-soft">
                        During checkout, you'll be shown a list of available Pick Up Mtaani agents in your area. Select the most convenient one and we'll deliver your order there.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="border border-rose-soft rounded-sm overflow-hidden">
                    <button class="w-full text-left p-4 md:p-6 flex justify-between items-center hover:bg-rose-soft/10 transition" onclick="toggleFAQ(this)">
                        <span class="text-sm md:text-base font-medium">What if my item arrives damaged?</span>
                        <span class="material-symbols-outlined text-gold-deep transition-transform">expand_more</span>
                    </button>
                    <div class="hidden p-4 md:p-6 pt-0 text-xs md:text-sm text-slate-600 border-t border-rose-soft">
                        Contact us immediately via WhatsApp with photos of the damage. We'll arrange for a replacement or refund at no cost to you.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="border border-rose-soft rounded-sm overflow-hidden">
                    <button class="w-full text-left p-4 md:p-6 flex justify-between items-center hover:bg-rose-soft/10 transition" onclick="toggleFAQ(this)">
                        <span class="text-sm md:text-base font-medium">How do I track my order?</span>
                        <span class="material-symbols-outlined text-gold-deep transition-transform">expand_more</span>
                    </button>
                    <div class="hidden p-4 md:p-6 pt-0 text-xs md:text-sm text-slate-600 border-t border-rose-soft">
                        Once your order ships, you'll receive an SMS with tracking information. For Pick Up Mtaani orders, you'll get an SMS when your order is ready for pickup.
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="border border-rose-soft rounded-sm overflow-hidden">
                    <button class="w-full text-left p-4 md:p-6 flex justify-between items-center hover:bg-rose-soft/10 transition" onclick="toggleFAQ(this)">
                        <span class="text-sm md:text-base font-medium">Do you ship outside Kenya?</span>
                        <span class="material-symbols-outlined text-gold-deep transition-transform">expand_more</span>
                    </button>
                    <div class="hidden p-4 md:p-6 pt-0 text-xs md:text-sm text-slate-600 border-t border-rose-soft">
                        Currently, we only ship within Kenya. We're working on expanding to East Africa soon!
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Support -->
    <section class="py-12 md:py-20 px-4 sm:px-6 lg:px-8 bg-gold-deep/5">
        <div class="max-w-2xl mx-auto text-center">
            <span class="material-symbols-outlined text-4xl text-gold-deep mb-4">support_agent</span>
            <h3 class="text-xl md:text-2xl font-light mb-4">Still Have Questions?</h3>
            <p class="text-xs md:text-sm text-slate-500 mb-6">
                Our customer care team is ready to help with any shipping or return questions.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://chat.whatsapp.com/H42ZcOwhr7F2WTGniVrnAF" target="_blank" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full text-xs tracking-widest uppercase transition">
                    WhatsApp Us
                </a>
                
            </div>
        </div>
    </section>
</main>

<script>
function toggleFAQ(button) {
    const content = button.nextElementSibling;
    const icon = button.querySelector('.material-symbols-outlined');
    
    // Toggle content
    content.classList.toggle('hidden');
    
    // Rotate icon
    if (content.classList.contains('hidden')) {
        icon.style.transform = 'rotate(0deg)';
    } else {
        icon.style.transform = 'rotate(180deg)';
    }
}
</script>
@endsection