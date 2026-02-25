@extends('layouts.admin')

@section('title', 'Instruction #REF-' . $order->id)
@section('page_title', 'Dispatch Specification')

@section('content')
<div class="mb-10 flex items-center justify-between">
    <a href="{{ route('admin.orders') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-adm-accent transition-all uppercase tracking-widest">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Return to Dispatch
    </a>

    <div class="flex items-center gap-4">
        <button onclick="window.print()" class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-600 px-6 py-3 rounded-xl text-xs font-bold hover:bg-slate-50 transition-all shadow-sm">
            <span class="material-symbols-outlined text-sm">print</span>
            Generate Invoice
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Transmission Specs (Order Items) -->
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <div>
                    <h4 class="font-bold text-slate-800 uppercase tracking-tight">Manifest Portfolio</h4>
                    <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mt-1">Transmission Timestamp: {{ $order->created_at->format('M d, Y @ H:i') }}</p>
                </div>
                <div class="px-3 py-1 bg-adm-accent/10 rounded-lg text-[10px] font-bold text-adm-accent uppercase tracking-widest">
                    {{ count($order->items) }} Unit(s)
                </div>
            </div>
            
            <div class="p-0">
                <table class="w-full text-left">
                    <thead class="bg-slate-50/20 border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Component</th>
                            <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Qty</th>
                            <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Unit Val</th>
                            <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right pr-10">Composite</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($order->items as $item)
                        <tr class="hover:bg-slate-50/30 transition-colors">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-slate-100 rounded-lg flex-shrink-0 border border-slate-200 overflow-hidden">
                                        @if($item->product && $item->product->featured_image)
                                            <img src="{{ asset($item->product->featured_image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                <span class="material-symbols-outlined text-sm">image</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-800 leading-tight">{{ $item->product_name }}</p>
                                        <p class="text-[9px] text-slate-400 uppercase tracking-widest mt-1 font-bold">Code: CS-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="text-xs font-bold text-slate-600">x{{ $item->quantity }}</span>
                            </td>
                            <td class="px-8 py-5 text-right font-medium text-slate-500 text-xs">
                                Ksh {{ number_format($item->price, 2) }}
                            </td>
                            <td class="px-8 py-5 text-right font-bold text-slate-800 text-xs pr-10">
                                Ksh {{ number_format($item->price * $item->quantity, 2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Totals Ledger -->
            <div class="p-8 bg-slate-50/50 border-t border-slate-100 flex justify-end">
                <div class="w-64 space-y-3">
                    <div class="flex justify-between text-xs text-slate-400 font-bold uppercase tracking-widest">
                        <span>Transmission Sum</span>
                        <span class="text-slate-600">Ksh {{ number_format($order->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-xs text-slate-400 font-bold uppercase tracking-widest">
                        <span>Courier Allocation</span>
                        <span class="text-slate-600">Included</span>
                    </div>
                    <div class="pt-4 border-t border-slate-200 flex justify-between">
                        <span class="text-sm font-bold text-slate-800 uppercase tracking-widest">Net Value</span>
                        <span class="text-lg font-black text-adm-accent">Ksh {{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Operations & Receiver -->
    <div class="space-y-8">
        <!-- Operation Controls -->
        <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm overflow-hidden relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-adm-accent/5 rounded-full -mr-12 -mt-12 blur-2xl"></div>
            
            <h4 class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-6">Internal Controls</h4>
            
            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
                
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Workflow State</label>
                    <select name="order_status" class="w-full bg-slate-50 border-slate-200 rounded-2xl px-5 py-4 text-xs font-bold text-slate-700 focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent transition-all appearance-none cursor-pointer">
                        <option value="pending" {{ $order->order_status === 'pending' ? 'selected' : '' }}>Pending Verification</option>
                        <option value="processing" {{ $order->order_status === 'processing' ? 'selected' : '' }}>In Production / Processing</option>
                        <option value="shipped" {{ $order->order_status === 'shipped' ? 'selected' : '' }}>Dispatched / Shipped</option>
                        <option value="delivered" {{ $order->order_status === 'delivered' ? 'selected' : '' }}>Verified Delivered</option>
                        <option value="cancelled" {{ $order->order_status === 'cancelled' ? 'selected' : '' }}>Transmission Terminated</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Escrow / Payment State</label>
                    <select name="payment_status" class="w-full bg-slate-100 border-none rounded-2xl px-5 py-4 text-xs font-bold text-slate-700/50 appearance-none cursor-not-allowed" disabled>
                        <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Unverified / Pending</option>
                        <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Success / Verified Fund</option>
                        <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Allocation Failure</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-adm-accent text-white py-4 rounded-2xl text-[10px] font-bold uppercase tracking-[0.3em] shadow-lg shadow-adm-accent/20 hover:bg-adm-dark hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 mt-2">
                    Commit Updates
                </button>
            </form>
        </div>

        <!-- Receiver Portfolio -->
        <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm space-y-6">
            <h4 class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em]">Receiver Specification</h4>
            
            <div class="flex items-center gap-4 pb-6 border-b border-slate-100">
                <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center font-black text-slate-400">
                    {{ substr($order->first_name, 0, 1) }}{{ substr($order->last_name, 0, 1) }}
                </div>
                <div>
                    <h5 class="text-sm font-bold text-slate-800 tracking-tight">{{ $order->first_name }} {{ $order->last_name }}</h5>
                    <p class="text-[10px] text-adm-accent font-bold uppercase tracking-wider">Verified Guest</p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Direct Communication</p>
                    <p class="text-xs font-bold text-slate-700">{{ $order->email }}</p>
                    <p class="text-xs font-bold text-slate-700 mt-0.5">{{ $order->phone }}</p>
                </div>
                <div>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Destination Node</p>
                    <p class="text-xs font-bold text-slate-700 leading-relaxed">{{ $order->address }}</p>
                    <p class="text-xs font-bold text-slate-700 mt-0.5">{{ $order->city }}, {{ $order->county }}</p>
                </div>
                <div>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Allocation Method</p>
                    <div class="flex items-center gap-2 mt-2">
                        <div class="px-3 py-1 bg-slate-100 rounded-lg text-[9px] font-black text-slate-500 uppercase tracking-widest">
                            {{ $order->payment_method }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
