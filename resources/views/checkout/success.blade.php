@extends('layouts.app')

@section('title', 'Order Placed | ScentCepts')

@section('content')
<main class="pb-20">

    <!-- Top accent bar -->
    <div class="h-1.5 bg-gradient-to-r from-[#25D366] via-gold-deep to-[#25D366]"></div>

    <section class="py-12 md:py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">

            <!-- Success icon + heading -->
            <div class="text-center mb-10">
                <div class="w-20 h-20 bg-[#25D366]/15 rounded-full flex items-center justify-center mx-auto mb-5 ring-8 ring-[#25D366]/10">
                    <svg class="w-10 h-10 text-[#25D366]" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.124.558 4.118 1.528 5.845L.057 23.882l6.188-1.448A11.934 11.934 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.791 9.791 0 01-4.988-1.365l-.356-.213-3.676.861.93-3.582-.234-.368A9.79 9.79 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182c5.43 0 9.818 4.388 9.818 9.818 0 5.43-4.388 9.818-9.818 9.818z"/>
                    </svg>
                </div>

                <h1 class="text-3xl md:text-4xl serif-heading font-light mb-3">
                    Order <span class="italic text-gold-deep">Received!</span>
                </h1>
                <p class="text-slate-500 text-sm md:text-base max-w-md mx-auto">
                    Thank you, <strong>{{ $order['customer'] }}</strong>! Your order has been recorded.
                    Now tap the button below to send your order details directly to our WhatsApp so we can confirm it with you.
                </p>

                <!-- Order ref badge -->
                <div class="inline-flex items-center gap-2 mt-4 bg-slate-100 rounded-full px-4 py-1.5 text-xs text-slate-600 font-mono">
                    <span class="material-symbols-outlined text-sm text-gold-deep">tag</span>
                    Order Reference: <strong>{{ $order['ref'] }}</strong>
                </div>
            </div>

            <!-- ─── WhatsApp CTA ─────────────────────────────────────────────── -->
            <div class="bg-[#25D366]/10 border-2 border-[#25D366]/40 rounded-xl p-6 text-center mb-8">
                <p class="text-sm font-semibold text-slate-700 mb-1">
                    📲 One last step — confirm your order on WhatsApp
                </p>
                <p class="text-xs text-slate-500 mb-5">
                    Tap the button below. Your order summary will be pre-filled — just hit <strong>Send</strong>!
                    We'll reply to confirm delivery fee &amp; M-PESA payment details.
                </p>

                <a href="{{ $order['whatsapp_url'] }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   id="whatsappConfirmBtn"
                   class="inline-flex items-center justify-center gap-3 bg-[#25D366] hover:bg-[#1ebe5d] active:scale-95 text-white font-semibold text-base px-8 py-4 rounded-full transition-all duration-200 shadow-lg shadow-[#25D366]/30 w-full sm:w-auto">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.124.558 4.118 1.528 5.845L.057 23.882l6.188-1.448A11.934 11.934 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.791 9.791 0 01-4.988-1.365l-.356-.213-3.676.861.93-3.582-.234-.368A9.79 9.79 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182c5.43 0 9.818 4.388 9.818 9.818 0 5.43-4.388 9.818-9.818 9.818z"/>
                    </svg>
                    Send Order on WhatsApp
                </a>

                <p class="text-[11px] text-slate-400 mt-3">
                    Opens WhatsApp with your order summary pre-filled · Message sent to +254 716 052 342
                </p>
            </div>

            <!-- ─── Order Summary Card ───────────────────────────────────────── -->
            <div class="bg-white rounded-xl shadow-[0_4px_24px_rgba(0,0,0,0.06)] overflow-hidden">
                <!-- Header -->
                <div class="bg-slate-800 text-white px-6 py-4 flex items-center justify-between">
                    <h2 class="font-medium text-sm tracking-wide uppercase flex items-center gap-2">
                        <span class="material-symbols-outlined text-gold-deep text-base">receipt_long</span>
                        Your Order Summary
                    </h2>
                    <span class="text-xs text-slate-400 font-mono">{{ $order['ref'] }}</span>
                </div>

                <!-- Customer info -->
                <div class="px-6 py-4 border-b border-slate-100 grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-wide mb-0.5">Name</p>
                        <p class="font-medium text-slate-800">{{ $order['customer'] }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-wide mb-0.5">Phone</p>
                        <p class="font-medium text-slate-800">{{ $order['phone'] }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-xs text-slate-400 uppercase tracking-wide mb-0.5">Delivery To</p>
                        <p class="font-medium text-slate-800">{{ $order['address'] }}, {{ $order['city'] }}, {{ $order['county'] }}</p>
                    </div>
                </div>

                <!-- Items -->
                <div class="px-6 py-4 border-b border-slate-100 space-y-3">
                    <p class="text-xs text-slate-400 uppercase tracking-wide">Items Ordered</p>
                    @foreach($order['items'] as $item)
                        <div class="flex justify-between items-start text-sm">
                            <div>
                                <p class="font-medium text-slate-800">
                                    {{ $item['brand'] ? $item['brand'] . ' – ' : '' }}{{ $item['name'] }}
                                </p>
                                <p class="text-xs text-slate-500">
                                    {{ $item['size'] }} · Qty {{ $item['quantity'] }}
                                </p>
                            </div>
                            <span class="text-gold-deep font-semibold text-sm shrink-0 ml-4">
                                Ksh {{ number_format($item['total']) }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <!-- Notes -->
                @if($order['notes'])
                <div class="px-6 py-3 border-b border-slate-100 text-sm">
                    <p class="text-xs text-slate-400 uppercase tracking-wide mb-1">Your Notes</p>
                    <p class="text-slate-600 italic">"{{ $order['notes'] }}"</p>
                </div>
                @endif

                <!-- Totals -->
                <div class="px-6 py-4 bg-slate-50">
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-slate-500">Products Subtotal</span>
                        <span class="font-medium">Ksh {{ number_format($order['subtotal']) }}</span>
                    </div>
                    <div class="flex justify-between text-sm mb-3">
                        <span class="text-slate-500">Delivery Fee</span>
                        <span class="text-[#25D366] font-medium">To be confirmed on WhatsApp</span>
                    </div>
                    <div class="flex justify-between text-base font-bold border-t border-slate-200 pt-3">
                        <span>Total (products)</span>
                        <span class="text-gold-deep">Ksh {{ number_format($order['subtotal']) }}</span>
                    </div>
                    <p class="text-xs text-slate-400 mt-1">+ delivery fee agreed on WhatsApp</p>
                </div>
            </div>

            <!-- ─── What Happens Next ────────────────────────────────────────── -->
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4 text-center text-sm">
                <div class="bg-white rounded-lg p-4 shadow-sm border border-slate-100">
                    <div class="w-10 h-10 bg-[#25D366]/10 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-[#25D366]" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.124.558 4.118 1.528 5.845L.057 23.882l6.188-1.448A11.934 11.934 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.791 9.791 0 01-4.988-1.365l-.356-.213-3.676.861.93-3.582-.234-.368A9.79 9.79 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182c5.43 0 9.818 4.388 9.818 9.818 0 5.43-4.388 9.818-9.818 9.818z"/>
                        </svg>
                    </div>
                    <p class="font-semibold text-slate-700 mb-1">1. Send on WhatsApp</p>
                    <p class="text-xs text-slate-500">Tap the green button above to send your order summary to us</p>
                </div>

                <div class="bg-white rounded-lg p-4 shadow-sm border border-slate-100">
                    <div class="w-10 h-10 bg-gold-deep/10 rounded-full flex items-center justify-center mx-auto mb-2">
                        <span class="material-symbols-outlined text-gold-deep text-lg">local_shipping</span>
                    </div>
                    <p class="font-semibold text-slate-700 mb-1">2. Confirm Delivery</p>
                    <p class="text-xs text-slate-500">We reply with the delivery fee & arrange pickup/delivery</p>
                </div>

                <div class="bg-white rounded-lg p-4 shadow-sm border border-slate-100">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <span class="material-symbols-outlined text-green-600 text-lg">payments</span>
                    </div>
                    <p class="font-semibold text-slate-700 mb-1">3. Pay via M-PESA</p>
                    <p class="text-xs text-slate-500">We send you our M-PESA till/paybill number to complete payment</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ $order['whatsapp_url'] }}"
                   target="_blank"
                   class="inline-flex items-center justify-center gap-2 bg-[#25D366] text-white px-6 py-3 rounded-full text-sm font-semibold hover:bg-[#1ebe5d] transition">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.124.558 4.118 1.528 5.845L.057 23.882l6.188-1.448A11.934 11.934 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.791 9.791 0 01-4.988-1.365l-.356-.213-3.676.861.93-3.582-.234-.368A9.79 9.79 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182c5.43 0 9.818 4.388 9.818 9.818 0 5.43-4.388 9.818-9.818 9.818z"/>
                    </svg>
                    Send Order on WhatsApp
                </a>

                <a href="{{ route('home') }}"
                   class="inline-flex items-center justify-center gap-2 border border-gold-deep text-gold-deep px-6 py-3 rounded-full text-sm font-medium hover:bg-gold-deep hover:text-white transition">
                    <span class="material-symbols-outlined text-base">shopping_bag</span>
                    Continue Shopping
                </a>
            </div>

        </div>
    </section>
</main>

@push('scripts')
<script>
    // Auto-open WhatsApp after a short delay (2 seconds) on page load
    setTimeout(function() {
        const btn = document.getElementById('whatsappConfirmBtn');
        if (btn) {
            btn.click();
        }
    }, 2000);
</script>
@endpush
@endsection