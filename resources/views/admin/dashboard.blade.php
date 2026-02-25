@extends('layouts.admin')

@section('title', 'Intelligence Hub')
@section('page_title', 'Strategic Overview')

@section('content')
<!-- Metric Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
    <!-- Gross Revenue Card -->
    <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group">
        <div class="flex items-center justify-between mb-8">
            <div class="p-4 bg-adm-accent/10 rounded-2xl text-adm-accent group-hover:bg-adm-accent group-hover:text-white transition-all duration-500 shadow-sm">
                <span class="material-symbols-outlined text-2xl font-bold">payments</span>
            </div>
            <div class="flex flex-col items-end">
                <span class="text-[10px] font-black text-adm-success bg-adm-success/10 px-3 py-1 rounded-lg border border-adm-success/10 uppercase tracking-widest">Growth</span>
                <span class="text-[9px] text-slate-400 font-bold uppercase mt-1 tracking-tighter">vs Last Month</span>
            </div>
        </div>
        <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Aggregate Value</p>
        <h4 class="text-3xl font-black text-slate-900 tracking-tighter serif-heading">
            <span class="text-adm-accent text-lg font-medium mr-1">Ksh</span>{{ number_format($total_sales, 2) }}
        </h4>
    </div>

    <!-- Total Orders Card -->
    <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group">
        <div class="flex items-center justify-between mb-8">
            <div class="p-4 bg-slate-900 rounded-2xl text-white group-hover:bg-adm-accent transition-all duration-500 shadow-xl">
                <span class="material-symbols-outlined text-2xl font-bold">shopping_cart</span>
            </div>
            <span class="text-[10px] font-black text-adm-warning bg-adm-warning/10 px-3 py-1 rounded-lg border border-adm-warning/10 uppercase tracking-widest">Operational</span>
        </div>
        <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Traffic Volume</p>
        <h4 class="text-4xl font-black text-slate-900 tracking-tighter serif-heading">{{ $total_orders }}</h4>
    </div>

    <!-- Customers Card -->
    <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group">
        <div class="flex items-center justify-between mb-8">
            <div class="p-4 bg-adm-success/10 rounded-2xl text-adm-success group-hover:bg-adm-success group-hover:text-white transition-all duration-500 shadow-sm">
                <span class="material-symbols-outlined text-2xl font-bold">group</span>
            </div>
            <span class="text-[10px] font-black text-adm-success bg-adm-success/10 px-3 py-1 rounded-lg border border-adm-success/10 uppercase tracking-widest">Loyalty</span>
        </div>
        <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Client Database</p>
        <h4 class="text-4xl font-black text-slate-900 tracking-tighter serif-heading">{{ $total_customers }}</h4>
    </div>

    <!-- Products Card -->
    <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group">
        <div class="flex items-center justify-between mb-8">
            <div class="p-4 bg-slate-100 rounded-2xl text-slate-400 group-hover:bg-slate-900 group-hover:text-white transition-all duration-500 shadow-sm">
                <span class="material-symbols-outlined text-2xl font-bold">inventory</span>
            </div>
            <span class="text-[10px] font-black text-slate-400 bg-slate-100 px-3 py-1 rounded-lg uppercase tracking-widest">Portfolio</span>
        </div>
        <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Curated Items</p>
        <h4 class="text-4xl font-black text-slate-900 tracking-tighter serif-heading">{{ $total_products }}</h4>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Recent Activity Table -->
    <div class="lg:col-span-2 bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden flex flex-col">
        <div class="px-8 py-7 border-b border-slate-100 flex items-center justify-between bg-white">
            <div>
                <h4 class="text-xl font-black text-slate-900 uppercase tracking-tighter serif-heading">Recent Manifests</h4>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Real-time surveillance of customer transactions</p>
            </div>
            <a href="{{ route('admin.orders') }}" class="inline-flex items-center gap-3 px-6 py-2.5 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-adm-accent transition-all duration-500 shadow-lg shadow-slate-900/10">
                Access Audit
                <span class="material-symbols-outlined text-xs">arrow_forward</span>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Reference</th>
                        <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Identity</th>
                        <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Valuation</th>
                        <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">Protocol</th>
                        <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recent_orders as $order)
                    <tr class="hover:bg-slate-50/10 transition duration-300">
                        <td class="px-8 py-6">
                            <span class="text-xs font-black text-slate-900 tracking-tighter px-3 py-1 bg-slate-100 rounded-lg">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-9 h-9 rounded-xl bg-adm-accent/10 border border-adm-accent/20 flex items-center justify-center font-black text-adm-accent text-xs">
                                    {{ substr($order->first_name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-xs font-black text-slate-800 leading-none">{{ $order->first_name }} {{ $order->last_name }}</p>
                                    <p class="text-[10px] text-slate-400 mt-1 uppercase tracking-widest font-bold">{{ $order->created_at->format('M d, H:i') }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-xs font-black text-slate-900 tracking-tighter serif-heading">Ksh {{ number_format($order->total_amount, 2) }}</span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="px-4 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-[0.1em] border-2
                                {{ in_array($order->order_status, ['pending', 'new']) ? 'bg-adm-warning/5 text-adm-warning border-adm-warning/20' : '' }}
                                {{ $order->order_status === 'processing' ? 'bg-adm-accent/5 text-adm-accent border-adm-accent/20' : '' }}
                                {{ $order->order_status === 'shipped' ? 'bg-blue-50 text-blue-600 border-blue-100' : '' }}
                                {{ $order->order_status === 'delivered' ? 'bg-adm-success/5 text-adm-success border-adm-success/20' : '' }}">
                                {{ $order->order_status }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <a href="{{ route('admin.orders.show', $order) }}" class="w-9 h-9 inline-flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-400 hover:border-adm-accent hover:text-adm-accent hover:shadow-lg transition-all duration-300">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <span class="material-symbols-outlined text-4xl text-slate-200">folder_open</span>
                                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">No active manifests detected</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Inventory Alert Card -->
    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden flex flex-col h-full hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
        <div class="px-8 py-7 border-b border-slate-100 bg-white">
            <h4 class="text-xl font-black text-slate-900 uppercase tracking-tighter serif-heading">Deficit Alert</h4>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Resources requiring replenishment</p>
        </div>
        <div class="p-8 space-y-6 flex-1 custom-scrollbar overflow-y-auto">
            @forelse($low_stock_products as $product)
            <div class="flex items-center justify-between group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-slate-50 border border-slate-100 rounded-xl overflow-hidden group-hover:border-adm-accent transition-all duration-300">
                        @if($product->featured_image)
                            <img src="{{ asset($product->featured_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-300">
                                <span class="material-symbols-outlined text-lg">image</span>
                            </div>
                        @endif
                    </div>
                    <div>
                        <p class="text-xs font-black text-slate-800 leading-tight group-hover:text-adm-accent transition-all duration-300">{{ Str::limit($product->name, 20) }}</p>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">{{ $product->brand->name ?? 'Maison Portfolio' }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-[11px] font-black {{ $product->stock_quantity == 0 ? 'text-adm-error bg-adm-error/5' : 'text-adm-warning bg-adm-warning/5' }} px-3 py-1 rounded-lg border border-current/10">
                        {{ $product->stock_quantity }} Unit{{ $product->stock_quantity != 1 ? 's' : '' }}
                    </p>
                </div>
            </div>
            @empty
            <div class="flex flex-col items-center justify-center py-10 opacity-30 grayscale">
                <span class="material-symbols-outlined text-4xl mb-3">inventory_2</span>
                <p class="text-[10px] font-black uppercase tracking-widest">Inventory Fully Sustained</p>
            </div>
            @endforelse
        </div>
        <div class="p-8 bg-slate-50/50 border-t border-slate-100">
            <a href="{{ route('admin.products') }}" class="flex items-center justify-center gap-3 w-full py-4 bg-white border border-slate-200 text-slate-900 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:border-adm-accent hover:text-adm-accent hover:shadow-xl transition-all duration-500 shadow-sm">
                Inventory Logistics
                <span class="material-symbols-outlined text-sm">settings_input_component</span>
            </a>
        </div>
    </div>
</div>
@endsection
