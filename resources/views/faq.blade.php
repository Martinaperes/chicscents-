@extends('layouts.app')

@section('title', 'Frequently Asked Questions | Chic Scents')

@section('content')
    <!-- Top Spacer -->
    <div class="h-11 w-full bg-ivory/90 sticky top-0 z-50 backdrop-blur-md"></div>

    <main class="pb-32">
        <!-- Header -->
        <div class="px-8 py-16 bg-rose-soft/20 text-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gold-deep/20 to-transparent"></div>
            
            <span class="text-[10px] uppercase tracking-[0.5em] font-semibold text-gold-deep mb-4 block">
                Got Questions?
            </span>
            
            <h1 class="text-5xl md:text-6xl serif-heading font-light mb-6">
                Frequently Asked Questions
            </h1>
            
            <p class="text-slate-500 max-w-2xl mx-auto">
                Find answers to common questions about our fragrances, shipping, and more.We do use pickup mtaani.
                Can't find what you're looking for? Reach out to us on <a href="https://www.instagram.com/chic_.scents" class="text-gold-deep hover:underline">Instagram</a> or <a href="https://wa.me/254716052342" class="text-gold-deep hover:underline">WhatsApp</a>.
            </p>

            <div class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gold-deep/20 to-transparent"></div>
        </div>

        <!-- Breadcrumb -->
        <div class="px-8 py-6 border-b border-rose-soft">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center gap-2 text-xs text-slate-400">
                    <a href="{{ route('home') }}" class="hover:text-gold-deep transition">Home</a>
                    <span>/</span>
                    <span class="text-gold-deep">FAQ</span>
                </div>
            </div>
        </div>

        <!-- Quick Contact Bar -->
        <div class="px-8 mt-8">
            <div class="max-w-4xl mx-auto bg-gold-deep/5 rounded-full p-2 flex flex-wrap justify-center gap-2">
                <a href="https://wa.me/254716052342" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-white rounded-full text-sm hover:shadow-md transition">
                    <span class="material-symbols-outlined text-gold-deep text-lg">chat</span>
                    <span>WhatsApp: +254 716 052 342</span>
                </a>
                <a href="https://www.instagram.com/chic_.scents" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-white rounded-full text-sm hover:shadow-md transition">
                    <span class="material-symbols-outlined text-gold-deep text-lg">photo_camera</span>
                    <span>@chic_.scents</span>
                </a>
            </div>
        </div>

        <!-- FAQ Categories -->
        <section class="px-8 mt-12">
            <div class="max-w-4xl mx-auto">
                <!-- Category Navigation -->
                <div class="flex flex-wrap justify-center gap-2 mb-12">
                    <button onclick="filterFaq('all')" class="faq-filter active px-6 py-2 rounded-full text-sm uppercase tracking-wider bg-gold-deep text-white transition">
                        All
                    </button>
                    <button onclick="filterFaq('ordering')" class="faq-filter px-6 py-2 rounded-full text-sm uppercase tracking-wider bg-rose-soft/50 text-slate-600 hover:bg-gold-deep/20 transition">
                        Ordering
                    </button>
                    <button onclick="filterFaq('shipping')" class="faq-filter px-6 py-2 rounded-full text-sm uppercase tracking-wider bg-rose-soft/50 text-slate-600 hover:bg-gold-deep/20 transition">
                        Shipping
                    </button>
                    <button onclick="filterFaq('products')" class="faq-filter px-6 py-2 rounded-full text-sm uppercase tracking-wider bg-rose-soft/50 text-slate-600 hover:bg-gold-deep/20 transition">
                        Products
                    </button>
                    <button onclick="filterFaq('decants')" class="faq-filter px-6 py-2 rounded-full text-sm uppercase tracking-wider bg-rose-soft/50 text-slate-600 hover:bg-gold-deep/20 transition">
                        Decants
                    </button>
                    <button onclick="filterFaq('payments')" class="faq-filter px-6 py-2 rounded-full text-sm uppercase tracking-wider bg-rose-soft/50 text-slate-600 hover:bg-gold-deep/20 transition">
                        Payments
                    </button>
                </div>

                <!-- FAQ Items -->
                <div class="space-y-4">
                    <!-- Ordering Questions -->
                    <div class="faq-item ordering bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center" onclick="toggleFaq(this)">
                            <span class="font-medium">How do I place an order?</span>
                            <span class="material-symbols-outlined text-gold-deep transition-transform duration-300">expand_more</span>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-slate-600">
                            <p>Orders can be placed directly through our website. Simply browse our products, select your preferred size (decant or full bottle), add to cart, and proceed to checkout. You'll receive an order confirmation via email once your order is placed.</p>
                        </div>
                    </div>

                    <div class="faq-item ordering bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center" onclick="toggleFaq(this)">
                            <span class="font-medium">Can I modify or cancel my order?</span>
                            <span class="material-symbols-outlined text-gold-deep transition-transform duration-300">expand_more</span>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-slate-600">
                            <p>Orders can be modified or canceled within 1 hour of placement. After that, orders are processed for shipping and cannot be changed. Contact us immediately on <a href="https://wa.me/254716052342" class="text-gold-deep hover:underline">WhatsApp</a> if you need to make changes.</p>
                        </div>
                    </div>

                    <!-- Shipping Questions -->
                    <div class="faq-item shipping bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center" onclick="toggleFaq(this)">
                            <span class="font-medium">How long does shipping take?</span>
                            <span class="material-symbols-outlined text-gold-deep transition-transform duration-300">expand_more</span>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-slate-600">
                            <p>Shipping typically takes 1-3 business days within Nairobi and 2-5 business days for upcountry destinations. You'll receive a tracking number once your order is dispatched.</p>
                        </div>
                    </div>

                    <div class="faq-item shipping bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center" onclick="toggleFaq(this)">
                            <span class="font-medium">How much is shipping?</span>
                            <span class="material-symbols-outlined text-gold-deep transition-transform duration-300">expand_more</span>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-slate-600">
                            <ul class="list-disc list-inside space-y-1">
                                <li>Nairobi: Kshs 150</li>
                                <li>Upcountry: Kshs 350</li>
                                <li>Free shipping on orders over Kshs 5,000</li>
                            </ul>
                        </div>
                    </div>

                    <div class="faq-item shipping bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center" onclick="toggleFaq(this)">
                            <span class="font-medium">Do you ship internationally?</span>
                            <span class="material-symbols-outlined text-gold-deep transition-transform duration-300">expand_more</span>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-slate-600">
                            <p>Currently, we only ship within Kenya. However, we're working on international shipping options and will announce when available.</p>
                        </div>
                    </div>

                    <!-- Product Questions -->
                    <div class="faq-item products bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center" onclick="toggleFaq(this)">
                            <span class="font-medium">Are your perfumes authentic?</span>
                            <span class="material-symbols-outlined text-gold-deep transition-transform duration-300">expand_more</span>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-slate-600">
                            <p>Yes! All our fragrances are 100% authentic, sourced directly from official distributors and reputable suppliers. We guarantee authenticity on every product.</p>
                        </div>
                    </div>

                    <div class="faq-item products bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center" onclick="toggleFaq(this)">
                            <span class="font-medium">How should I store my perfumes?</span>
                            <span class="material-symbols-outlined text-gold-deep transition-transform duration-300">expand_more</span>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-slate-600">
                            <p>Store perfumes in a cool, dry place away from direct sunlight and temperature fluctuations. Avoid bathrooms as humidity can affect the fragrance. Proper storage helps maintain the scent's integrity.</p>
                        </div>
                    </div>

                    <!-- Decants Questions -->
                    <div class="faq-item decants bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center" onclick="toggleFaq(this)">
                            <span class="font-medium">What are decants?</span>
                            <span class="material-symbols-outlined text-gold-deep transition-transform duration-300">expand_more</span>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-slate-600">
                            <p>Decants are small, sample-sized amounts 10ml of fragrance from original bottles. They're perfect for testing a scent before committing to a full bottle, or for traveling.</p>
                        </div>
                    </div>

                    <div class="faq-item decants bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center" onclick="toggleFaq(this)">
                            <span class="font-medium">How long do decants last?</span>
                            <span class="material-symbols-outlined text-gold-deep transition-transform duration-300">expand_more</span>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-slate-600">
                            <p> A 10ml decant provides 100-150 sprays, lasting 1-2 months.</p>
                        </div>
                    </div>

                    <!-- Payments Questions -->
                    <div class="faq-item payments bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center" onclick="toggleFaq(this)">
                            <span class="font-medium">What payment methods do you accept?</span>
                            <span class="material-symbols-outlined text-gold-deep transition-transform duration-300">expand_more</span>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-slate-600">
                            <p>We accept:</p>
                            <ul class="list-disc list-inside mt-2">
                                <li>M-Pesa (Lipa Na M-Pesa)</li>
                                <li>Card payments (Visa, Mastercard)</li>
                                <li>Bank transfers</li>
                            </ul>
                        </div>
                    </div>

                    <div class="faq-item payments bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center" onclick="toggleFaq(this)">
                            <span class="font-medium">Is M-Pesa payment available?</span>
                            <span class="material-symbols-outlined text-gold-deep transition-transform duration-300">expand_more</span>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-slate-600">
                            <p>Yes! We accept M-Pesa payments. During checkout, you'll receive our paybill number and account number to complete the payment. Once paid, your order is automatically confirmed.</p>
                        </div>
                    </div>
                </div>

                <!-- Still Have Questions -->
                <div class="mt-12 text-center p-8 bg-rose-soft/20 rounded-lg">
                    <span class="material-symbols-outlined text-4xl text-gold-deep mb-3">help</span>
                    <h3 class="text-xl serif-heading font-light mb-2">Still Have Questions?</h3>
                    <p class="text-slate-500 mb-6">We're here to help! Reach out to us directly.</p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="https://wa.me/254716052342" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-gold-deep text-white rounded-full hover:opacity-90 transition">
                            <span class="material-symbols-outlined">chat</span>
                            WhatsApp Us
                        </a>
                        <a href="https://www.instagram.com/chic_.scents" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 border border-gold-deep text-gold-deep rounded-full hover:bg-gold-deep/10 transition">
                            <span class="material-symbols-outlined">photo_camera</span>
                            DM on Instagram
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
<script>
// Toggle FAQ answer
function toggleFaq(button) {
    const answer = button.nextElementSibling;
    const icon = button.querySelector('.material-symbols-outlined');
    
    // Toggle answer visibility
    answer.classList.toggle('hidden');
    
    // Rotate icon
    icon.style.transform = answer.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
}

// Filter FAQs by category
function filterFaq(category) {
    const items = document.querySelectorAll('.faq-item');
    const filters = document.querySelectorAll('.faq-filter');
    
    // Update active filter button
    filters.forEach(filter => {
        if (filter.textContent.toLowerCase().includes(category) || (category === 'all' && filter.textContent === 'All')) {
            filter.classList.remove('bg-rose-soft/50', 'text-slate-600');
            filter.classList.add('bg-gold-deep', 'text-white');
        } else {
            filter.classList.remove('bg-gold-deep', 'text-white');
            filter.classList.add('bg-rose-soft/50', 'text-slate-600');
        }
    });
    
    // Show/hide items
    items.forEach(item => {
        if (category === 'all' || item.classList.contains(category)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

// Search functionality (optional)
function searchFaq() {
    const searchTerm = document.getElementById('faq-search').value.toLowerCase();
    const items = document.querySelectorAll('.faq-item');
    
    items.forEach(item => {
        const question = item.querySelector('.faq-question span').textContent.toLowerCase();
        const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
        
        if (question.includes(searchTerm) || answer.includes(searchTerm)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>
@endpush