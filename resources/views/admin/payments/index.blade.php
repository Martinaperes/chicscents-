@extends('layouts.admin')

@section('title', 'Financial Ledger')
@section('page_title', 'Revenue Streams')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white p-8 rounded-3xl border border-slate-200 shadow-sm relative overflow-hidden">
    <div class="absolute top-0 right-0 w-32 h-32 bg-adm-success/5 rounded-full -mr-16 -mt-16 blur-3xl"></div>
    <div>
        <h3 class="text-xl font-bold text-slate-800">Payment Audit</h3>
        <p class="text-xs text-slate-400">Total verified incoming transmissions: {{ $payments->total() }} records</p>
    </div>

    <div class="flex items-center gap-4">
        <button class="inline-flex items-center gap-3 bg-adm-success text-white px-8 py-4 rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] hover:bg-slate-900 hover:shadow-2xl hover:shadow-adm-success/40 transition-all duration-300 active:scale-95 group">
            <span class="material-symbols-outlined text-sm group-hover:translate-y-1 transition-transform">download</span>
            Generate Financial Audit
        </button>
    </div>
</div>

<div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-10">Transaction Reference</th>
                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Allocation Channel</th>
                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">Protocol Date</th>
                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Settlement Val</th>
                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center pr-10">Verification Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($payments as $order)
                <tr class="group hover:bg-slate-50/50 transition-colors">
                    <td class="px-8 py-6 pl-10">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center font-black text-xs text-slate-400">
                                #{{ $order->id }}
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800 uppercase tracking-tight">ORDER-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">{{ $order->first_name }} {{ $order->last_name }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-adm-success"></div>
                            <span class="text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">{{ $order->payment_method }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="text-xs font-black text-slate-800 uppercase tracking-tighter">{{ $order->updated_at->format('d M, Y @ H:i') }}</span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <p class="text-sm font-black text-slate-900 tracking-tight">Ksh {{ number_format($order->total_amount, 2) }}</p>
                    </td>
                    <td class="px-8 py-6 text-center pr-10">
                        <span class="inline-flex items-center px-4 py-1.5 bg-adm-success text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-adm-success/20">
                            {{ $order->payment_status }} verified
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-24 text-center">
                        <div class="flex flex-col items-center opacity-20">
                            <span class="material-symbols-outlined text-5xl mb-4">account_balance_wallet</span>
                            <p class="text-xs font-bold uppercase tracking-[0.3em]">No Financial Settlements Found</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($payments->hasPages())
    <div class="px-10 py-6 border-t border-slate-100 bg-slate-50/50">
        {{ $payments->links() }}
    </div>
    @endif
</div>
@endsection
