@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Business Intelligence')

@section('content')
<!-- Metric Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
    <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
        <div class="flex items-center justify-between mb-6">
            <div class="p-3.5 bg-adm-accent/10 rounded-2xl text-adm-accent group-hover:bg-adm-accent group-hover:text-white transition-all duration-500">
                <span class="material-symbols-outlined text-2xl font-bold">payments</span>
            </div>
            <span class="text-[11px] font-black text-adm-success bg-adm-success/10 px-3 py-1.5 rounded-xl border border-adm-success/10 uppercase tracking-widest">+12.5%</span>
        </div>
        <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 font-sans">Gross Revenue</p>
        <h4 class="text-3xl font-black text-slate-900 tracking-tighter">Ksh {{ number_format($total_sales, 2) }}</h4>
    </div>

    <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
        <div class="flex items-center justify-between mb-6">
            <div class="p-3.5 bg-adm-warning/10 rounded-2xl text-adm-warning group-hover:bg-adm-warning group-hover:text-white transition-all duration-500">
                <span class="material-symbols-outlined text-2xl font-bold">shopping_cart</span>
            </div>
            <span class="text-[11px] font-black text-adm-warning bg-adm-warning/10 px-3 py-1.5 rounded-xl border border-adm-warning/10 uppercase tracking-widest">Active</span>
        </div>
        <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 font-sans">Total Orders</p>
        <h4 class="text-3xl font-black text-slate-900 tracking-tighter">{{ $total_orders }}</h4>
    </div>

    <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
        <div class="flex items-center justify-between mb-6">
            <div class="p-3.5 bg-adm-success/10 rounded-2xl text-adm-success group-hover:bg-adm-success group-hover:text-white transition-all duration-500">
                <span class="material-symbols-outlined text-2xl font-bold">group</span>
            </div>
            <span class="text-[11px] font-black text-adm-success bg-adm-success/10 px-3 py-1.5 rounded-xl border border-adm-success/10 uppercase tracking-widest">Verified</span>
        </div>
        <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 font-sans">Total Clients</p>
        <h4 class="text-3xl font-black text-slate-900 tracking-tighter">{{ $total_customers }}</h4>
    </div>

    <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
        <div class="flex items-center justify-between mb-6">
            <div class="p-3.5 bg-adm-info/10 rounded-2xl text-adm-info group-hover:bg-adm-info group-hover:text-white transition-all duration-500">
                <span class="material-symbols-outlined text-2xl font-bold">inventory</span>
            </div>
            <span class="text-[11px] font-black text-adm-info bg-adm-info/10 px-3 py-1.5 rounded-xl border border-adm-info/10 uppercase tracking-widest">Stocked</span>
        </div>
        <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 font-sans">Fragrances</p>
        <h4 class="text-3xl font-black text-slate-900 tracking-tighter">{{ $total_products }}</h4>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Recent Activity Table -->
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <div>
                <h4 class="font-black text-slate-900 uppercase tracking-tighter">Recent Transactions</h4>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Manage your latest incoming orders</p>
            </div>
            <a href="{{ route('admin.orders') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-adm-accent/10 text-adm-accent rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-adm-accent hover:text-white transition-all duration-300">
                View Ledger
                <span class="material-symbols-outlined text-xs">arrow_forward</span>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/80 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] pl-8">Order Ref</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Client Identity</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Settlement</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">Status</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right pr-8">Control</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recent_orders as $order)
                    <tr class="hover:bg-slate-50/50 transition duration-150">
                        <td class="px-6 py-4 pl-8">
                            <span class="text-xs font-bold text-slate-800 tracking-tight">#{{ $order->id }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-xs font-bold text-slate-700 leading-none">{{ $order->first_name }} {{ $order->last_name }}</p>
                            <p class="text-[10px] text-slate-400 mt-1 uppercase">{{ $order->created_at->diffForHumans() }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold text-slate-800">Ksh {{ number_format($order->total_amount, 2) }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider
                                {{ in_array($order->order_status, ['pending', 'new']) ? 'bg-adm-warning/10 text-adm-warning' : '' }}
                                {{ $order->order_status === 'processing' ? 'bg-adm-accent/10 text-adm-accent' : '' }}
                                {{ $order->order_status === 'shipped' ? 'bg-adm-info/10 text-adm-info' : '' }}
                                {{ $order->order_status === 'delivered' ? 'bg-adm-success/10 text-adm-success' : '' }}">
                                {{ $order->order_status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right pr-8">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-adm-accent/5 text-adm-accent border border-adm-accent/10 rounded-lg text-[9px] font-black uppercase tracking-widest hover:bg-adm-accent hover:text-white transition-all">
                                <span class="material-symbols-outlined text-[14px]">visibility</span>
                                Review
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-xs text-slate-400 font-medium uppercase tracking-[0.2em] italic">No active transactions found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Inventory Alerts -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm flex flex-col h-full overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/30">
            <h4 class="font-black text-slate-900 uppercase tracking-tighter">Stock Threshold Alerts</h4>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Products requiring immediate restock</p>
        </div>
        <div class="p-6 space-y-4 flex-1">
            @forelse($low_stock_products as $product)
            <div class="flex items-center gap-4 p-4 rounded-2xl border border-slate-100 bg-slate-50/30 hover:bg-white hover:border-adm-error/30 hover:shadow-lg transition-all duration-300 group">
                <div class="w-12 h-12 rounded-xl bg-white shadow-sm flex-shrink-0 flex items-center justify-center border border-slate-100 overflow-hidden group-hover:scale-105 transition-transform duration-500">
                    @if($product->featured_image)
                        <img src="{{ asset($product->featured_image) }}" class="w-full h-full object-cover">
                    @else
                        <span class="material-symbols-outlined text-slate-200">image</span>
                    @endif
                </div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-[11px] font-black text-slate-900 truncate uppercase tracking-tighter">{{ $product->name }}</p>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-adm-error animate-pulse"></span>
                        <p class="text-[10px] font-black text-adm-error uppercase tracking-widest">{{ $product->stock_quantity }} units left</p>
                    </div>
                </div>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-300 hover:text-white hover:bg-adm-accent hover:shadow-lg transition-all duration-300">
                    <span class="material-symbols-outlined text-lg">edit_note</span>
                </a>
            </div>
            @empty
            <div class="flex flex-col items-center justify-center py-10 text-center opacity-30 grayscale">
                <span class="material-symbols-outlined text-4xl mb-2">check_circle</span>
                <p class="text-xs font-black uppercase tracking-widest">Inventory Levels Healthy</p>
            </div>
            @endforelse
        </div>
        <div class="p-6 bg-slate-50/80 border-t border-slate-100">
            <a href="{{ route('admin.products') }}" class="flex items-center justify-center gap-3 w-full py-4 bg-white border border-slate-200 rounded-2xl text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] hover:bg-slate-900 hover:text-white hover:border-slate-900 hover:shadow-2xl transition-all duration-300 active:scale-95 group">
                Full Inventory Report
                <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </a>
        </div>
    </div>
</div>
@endsection
