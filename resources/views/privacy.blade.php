@extends('layouts.app')

@section('title', 'Privacy Policy | ScentCepts')

@section('content')
<main class="pb-16 md:pb-32">
    <!-- Hero Section -->
    <section class="relative h-[30vh] md:h-[40vh] min-h-[200px] md:min-h-[300px] overflow-hidden">
        <img 
            src="https://images.unsplash.com/photo-1633265486064-086b219458ec?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
            alt="Privacy and security"
            class="absolute inset-0 w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="absolute inset-0 flex items-center justify-center text-center text-white px-4">
            <div>
                <span class="text-[10px] md:text-[11px] uppercase tracking-[0.3em] md:tracking-[0.5em] font-medium text-gold-deep mb-3 md:mb-4 block">
                    Your Trust Matters
                </span>
                <h1 class="text-3xl md:text-5xl lg:text-7xl serif-heading font-light mb-3 md:mb-6">
                    Privacy <span class="italic text-gold-deep">Policy</span>
                </h1>
                <p class="text-xs md:text-sm lg:text-base max-w-2xl mx-auto font-light text-gray-200">
                    How we protect and handle your personal information
                </p>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <x-divider />

    <!-- Privacy Content -->
    <section class="py-12 md:py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Last Updated -->
            <div class="text-right mb-8">
                <p class="text-xs text-slate-400">Last Updated: {{ date('F j, Y') }}</p>
            </div>

            <!-- Introduction -->
            <div class="prose prose-sm md:prose-base max-w-none text-slate-600">
                <p class="text-sm md:text-base leading-relaxed mb-8">
                    At ScentCepts, we take your privacy seriously. This policy describes how we collect, use, and protect your personal information when you visit our website or make a purchase.
                </p>

                <!-- Section 1 -->
                <div class="mb-10">
                    <h2 class="text-xl md:text-2xl serif-heading font-light mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-gold-deep/10 rounded-full flex items-center justify-center">
                            <span class="text-gold-deep text-sm">1</span>
                        </span>
                        Information We Collect
                    </h2>
                    <div class="pl-10">
                        <h3 class="text-base md:text-lg font-medium mb-3">When you make a purchase, we collect:</h3>
                        <ul class="list-disc pl-5 space-y-2 text-sm md:text-base text-slate-600 mb-4">
                            <li>Full name and contact information (phone number, email address)</li>
                            <li>Shipping address for delivery</li>
                            <li>Payment information (processed securely through our payment partners)</li>
                            <li>Order history and preferences</li>
                        </ul>
                        
                        <h3 class="text-base md:text-lg font-medium mb-3">Automatically collected:</h3>
                        <ul class="list-disc pl-5 space-y-2 text-sm md:text-base text-slate-600">
                            <li>IP address and browser information</li>
                            <li>Pages visited and interactions on our site</li>
                            <li>Device information for optimization</li>
                        </ul>
                    </div>
                </div>

                <!-- Section 2 -->
                <div class="mb-10">
                    <h2 class="text-xl md:text-2xl serif-heading font-light mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-gold-deep/10 rounded-full flex items-center justify-center">
                            <span class="text-gold-deep text-sm">2</span>
                        </span>
                        How We Use Your Information
                    </h2>
                    <div class="pl-10 space-y-3 text-sm md:text-base text-slate-600">
                        <p>We use your information to:</p>
                        <ul class="list-disc pl-5 space-y-2">
                            <li>Process and deliver your orders</li>
                            <li>Send order confirmations and shipping updates via SMS</li>
                            <li>Respond to your questions and concerns</li>
                            <li>Improve our website and customer experience</li>
                            <li>Send promotional offers (only with your consent)</li>
                            <li>Prevent fraud and ensure security</li>
                        </ul>
                    </div>
                </div>

                <!-- Section 3 -->
                <div class="mb-10">
                    <h2 class="text-xl md:text-2xl serif-heading font-light mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-gold-deep/10 rounded-full flex items-center justify-center">
                            <span class="text-gold-deep text-sm">3</span>
                        </span>
                        Information Sharing
                    </h2>
                    <div class="pl-10 text-sm md:text-base text-slate-600">
                        <p class="mb-3">We never sell your personal information. We only share data with:</p>
                        <ul class="list-disc pl-5 space-y-2">
                            <li><span class="font-medium">Delivery partners:</span> To ship your order (name, phone, address)</li>
                            <li><span class="font-medium">Payment processors:</span> To securely handle transactions</li>
                            <li><span class="font-medium">Legal requirements:</span> When required by law</li>
                        </ul>
                    </div>
                </div>

                <!-- Section 4 -->
                <div class="mb-10">
                    <h2 class="text-xl md:text-2xl serif-heading font-light mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-gold-deep/10 rounded-full flex items-center justify-center">
                            <span class="text-gold-deep text-sm">4</span>
                        </span>
                        Data Security
                    </h2>
                    <div class="pl-10 text-sm md:text-base text-slate-600">
                        <p>We implement industry-standard security measures including:</p>
                        <ul class="list-disc pl-5 mt-2 space-y-2">
                            <li>SSL encryption for all data transmission</li>
                            <li>Secure payment processing (we never store credit card details)</li>
                            <li>Regular security audits</li>
                            <li>Limited staff access to personal information</li>
                        </ul>
                    </div>
                </div>

                <!-- Section 5 -->
                <div class="mb-10">
                    <h2 class="text-xl md:text-2xl serif-heading font-light mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-gold-deep/10 rounded-full flex items-center justify-center">
                            <span class="text-gold-deep text-sm">5</span>
                        </span>
                        Your Rights
                    </h2>
                    <div class="pl-10 text-sm md:text-base text-slate-600">
                        <p>You have the right to:</p>
                        <ul class="list-disc pl-5 mt-2 space-y-2">
                            <li>Access the personal information we hold about you</li>
                            <li>Request correction of inaccurate data</li>
                            <li>Request deletion of your data (subject to legal requirements)</li>
                            <li>Opt out of marketing communications</li>
                            <li>Withdraw consent at any time</li>
                        </ul>
                    </div>
                </div>

                <!-- Section 6 -->
                <div class="mb-10">
                    <h2 class="text-xl md:text-2xl serif-heading font-light mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-gold-deep/10 rounded-full flex items-center justify-center">
                            <span class="text-gold-deep text-sm">6</span>
                        </span>
                        Cookies
                    </h2>
                    <div class="pl-10 text-sm md:text-base text-slate-600">
                        <p>We use cookies to:</p>
                        <ul class="list-disc pl-5 mt-2 space-y-2">
                            <li>Remember items in your cart</li>
                            <li>Understand how you use our site</li>
                            <li>Improve your browsing experience</li>
                            <li>Provide relevant product recommendations</li>
                        </ul>
                        <p class="mt-4">You can disable cookies in your browser settings, but some site features may not function properly.</p>
                    </div>
                </div>

                <!-- Section 7 -->
                <div class="mb-10">
                    <h2 class="text-xl md:text-2xl serif-heading font-light mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-gold-deep/10 rounded-full flex items-center justify-center">
                            <span class="text-gold-deep text-sm">7</span>
                        </span>
                        WhatsApp Communications
                    </h2>
                    <div class="pl-10 text-sm md:text-base text-slate-600">
                        <p>When you contact us via WhatsApp:</p>
                        <ul class="list-disc pl-5 mt-2 space-y-2">
                            <li>Your phone number is used only for responding to your inquiry</li>
                            <li>We don't add you to broadcast lists without consent</li>
                            <li>Chat history may be kept for customer service purposes</li>
                            <li>You can request deletion of chat history anytime</li>
                        </ul>
                    </div>
                </div>

                <!-- Section 8 -->
                <div class="mb-10">
                    <h2 class="text-xl md:text-2xl serif-heading font-light mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-gold-deep/10 rounded-full flex items-center justify-center">
                            <span class="text-gold-deep text-sm">8</span>
                        </span>
                        Children's Privacy
                    </h2>
                    <div class="pl-10 text-sm md:text-base text-slate-600">
                        <p>Our website is not intended for children under 18. We do not knowingly collect information from minors.</p>
                    </div>
                </div>

                <!-- Section 9 -->
                <div class="mb-10">
                    <h2 class="text-xl md:text-2xl serif-heading font-light mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-gold-deep/10 rounded-full flex items-center justify-center">
                            <span class="text-gold-deep text-sm">9</span>
                        </span>
                        Policy Updates
                    </h2>
                    <div class="pl-10 text-sm md:text-base text-slate-600">
                        <p>We may update this policy occasionally. Changes will be posted on this page with an updated revision date.</p>
                    </div>
                </div>

                <!-- Section 10 -->
                <div class="mb-10">
                    <h2 class="text-xl md:text-2xl serif-heading font-light mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-gold-deep/10 rounded-full flex items-center justify-center">
                            <span class="text-gold-deep text-sm">10</span>
                        </span>
                        Contact Us
                    </h2>
                    <div class="pl-10 text-sm md:text-base text-slate-600">
                        <p>For privacy questions or requests:</p>
                        <div class="mt-4 p-6 bg-rose-soft/20 rounded-sm">
                            <p class="mb-2"><span class="font-medium">WhatsApp:</span> 0716 052342</p>
                            <p><span class="font-medium">Address:</span> Nairobi, Kenya</p>
                        </div>
                    </div>
                </div>

                <!-- Consent Statement -->
                <div class="mt-12 p-6 bg-gold-deep/5 border border-gold-deep/20 rounded-sm text-center">
                    <span class="material-symbols-outlined text-3xl text-gold-deep mb-2">verified_user</span>
                    <p class="text-sm text-slate-600">
                        By using our website, you consent to our privacy policy and agree to its terms.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <x-divider />

    <!-- Still Have Questions -->
    <section class="py-12 md:py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <h3 class="text-xl md:text-2xl font-light mb-4">Questions About Your Privacy?</h3>
            <p class="text-xs md:text-sm text-slate-500 mb-8">
                We're here to address any concerns about how we handle your information.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://chat.whatsapp.com/H42ZcOwhr7F2WTGniVrnAF" target="_blank" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full text-xs tracking-widest uppercase transition">
                    WhatsApp Us
                </a>
                
            </div>
        </div>
    </section>
</main>
@endsection