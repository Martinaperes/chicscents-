@extends('layouts.admin')

@section('title', 'Orders Management')
@section('page_title', 'Transaction Ledger')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white p-8 rounded-3xl border border-slate-200 shadow-sm relative overflow-hidden">
    <div class="absolute top-0 right-0 w-32 h-32 bg-adm-accent/5 rounded-full -mr-16 -mt-16 blur-3xl"></div>
    <div>
        <h3 class="text-xl font-bold text-slate-800">Order Dispatch</h3>
        <p class="text-xs text-slate-400">Total volume in processing: {{ $orders->total() }} shipments</p>
    </div>

    <div class="flex items-center gap-4">
        <div class="relative group">
            <span class="material-symbols-outlined absolute left-3 top-3 text-slate-400 text-lg transition-colors group-focus-within:text-adm-accent">search</span>
            <input type="text" placeholder="Search order ID..." class="bg-slate-50 border-slate-200 rounded-xl pl-10 pr-4 py-3 text-xs w-64 focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all">
        </div>
        
        <button class="inline-flex items-center gap-3 bg-white border border-slate-200 text-slate-700 px-8 py-4 rounded-2x rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] hover:bg-slate-50 hover:border-slate-300 hover:shadow-lg transition-all active:scale-95 group">
            <span class="material-symbols-outlined text-sm text-slate-400 group-hover:text-adm-accent transition-colors">filter_list</span>
            Sort Ledger
        </button>
    </div>
</div>

<div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/80 border-b border-slate-100">
                    <th class="px-10 py-6 text-[11px] font-black text-slate-400 uppercase tracking-widest pl-12">Transmission Ref</th>
                    <th class="px-10 py-6 text-[11px] font-black text-slate-400 uppercase tracking-widest">Client Identity</th>
                    <th class="px-10 py-6 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">Batch Vol</th>
                    <th class="px-10 py-6 text-[11px] font-black text-slate-400 uppercase tracking-widest text-right">Settlement Val</th>
                    <th class="px-10 py-6 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">Flow Status</th>
                    <th class="px-10 py-6 text-[11px] font-black text-slate-400 uppercase tracking-widest text-right pr-12">Inspection</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($orders as $order)
                <tr class="group hover:bg-ivory/50 transition-colors">
                    <td class="px-10 py-8 pl-12">
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 rounded-2xl bg-slate-900 border border-slate-800 flex items-center justify-center font-black text-white shadow-lg group-hover:bg-adm-accent transition-all duration-500">
                                #{{ $order->id }}
                            </div>
                            <div>
                                <p class="text-[11px] font-black text-slate-900 uppercase tracking-tighter">REF-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                                <p class="text-[9px] text-slate-400 mt-1 uppercase font-bold tracking-widest">{{ $order->created_at->format('M d, H:i') }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-xs font-black text-slate-900">{{ $order->first_name }} {{ $order->last_name }}</p>
                        <p class="text-[10px] text-slate-500 font-medium mt-0.5">{{ $order->email }}</p>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="px-3.5 py-1.5 bg-slate-100 rounded-xl text-[10px] font-black text-slate-600 uppercase border border-slate-200 shadow-sm">Items: {{ $order->items_count ?? 0 }}</span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <p class="text-sm font-black text-slate-900 tracking-tight">Ksh {{ number_format($order->total_amount, 2) }}</p>
                        <p class="text-[9px] font-black uppercase tracking-widest mt-1 {{ $order->payment_status === 'paid' ? 'text-adm-success' : 'text-adm-warning' }}">{{ $order->payment_status }}</p>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm border
                            {{ in_array($order->order_status, ['pending', 'new']) ? 'bg-adm-warning/10 text-adm-warning border-adm-warning/20' : '' }}
                            {{ $order->order_status === 'processing' ? 'bg-adm-accent/10 text-adm-accent border-adm-accent/20' : '' }}
                            {{ $order->order_status === 'shipped' ? 'bg-adm-info/10 text-adm-info border-adm-info/20' : '' }}
                            {{ $order->order_status === 'delivered' ? 'bg-adm-success/10 text-adm-success border-adm-success/20' : '' }}
                            {{ $order->order_status === 'cancelled' ? 'bg-adm-error/10 text-adm-error border-adm-error/20' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full mr-2 
                                {{ in_array($order->order_status, ['pending', 'new']) ? 'bg-adm-warning' : '' }}
                                {{ $order->order_status === 'processing' ? 'bg-adm-accent' : '' }}
                                {{ $order->order_status === 'shipped' ? 'bg-adm-info' : '' }}
                                {{ $order->order_status === 'delivered' ? 'bg-adm-success' : '' }}
                                {{ $order->order_status === 'cancelled' ? 'bg-adm-error' : '' }}"></span>
                            {{ $order->order_status }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right pr-12">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-adm-accent/10 border border-adm-accent/20 text-adm-accent hover:bg-adm-accent hover:text-white transition-all duration-300">
                            <span class="material-symbols-outlined text-sm">visibility</span>
                            <span class="text-[10px] font-black uppercase tracking-widest">Inspect</span>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-24 text-center">
                        <div class="flex flex-col items-center opacity-20">
                            <span class="material-symbols-outlined text-5xl mb-4">move_to_inbox</span>
                            <p class="text-xs font-bold uppercase tracking-[0.3em]">No Recorded Transmissions</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($orders->hasPages())
    <div class="px-10 py-6 border-t border-slate-100 bg-slate-50/50">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
