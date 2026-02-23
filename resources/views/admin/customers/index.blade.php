@extends('layouts.admin')

@section('title', 'CRM Directory')
@section('page_title', 'Guest Portfolio')

@section('content')
@php
    // Preserve query parameters for pagination, search, etc.
    $queryParams = request()->except('page');
@endphp

<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white p-8 rounded-3xl border border-slate-200 shadow-sm relative overflow-hidden">
    <!-- decorative background element using your accent color -->
    <div class="absolute top-0 right-0 w-32 h-32 bg-[#ad7e6c]/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
    <div>
        <h3 class="text-xl font-bold text-slate-800">Client Acquisition</h3>
        <p class="text-xs text-slate-400">Total verified guests in database: {{ $customers->total() }} accounts</p>
    </div>

    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">
        <!-- Search Form – now functional -->
        <form method="GET" action="{{ route('admin.customers') }}" class="relative group flex-1 sm:flex-initial">
            <label for="search-input" class="sr-only">Search clients</label>
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg transition-colors group-focus-within:text-[#ad7e6c] pointer-events-none">search</span>
            <input
                type="text"
                id="search-input"
                name="search"
                value="{{ request('search') }}"
                placeholder="Locate client..."
                class="w-full sm:w-64 bg-slate-50 border-slate-200 rounded-xl pl-10 pr-10 py-3 text-xs focus:ring-4 focus:ring-[#ad7e6c]/10 focus:border-[#ad7e6c] focus:bg-white transition-all"
            >
            @if(request('search'))
                <a href="{{ route('admin.customers', array_merge(request()->except('search', 'page'))) }}"
                   class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-red-500 transition">
                    <span class="material-symbols-outlined text-lg">close</span>
                </a>
            @endif
        </form>

        <!-- Optional Status Filter (you can add later if needed) -->

        <!-- Dispatch Briefing Button -->
        <button class="inline-flex items-center justify-center gap-3 bg-[#ad7e6c] text-white px-8 py-4 rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] hover:bg-black hover:text-[#ad7e6c] transition-all duration-300 active:scale-95 group whitespace-nowrap">
            <span class="material-symbols-outlined text-sm group-hover:animate-bounce transition-all">mail</span>
            Dispatch Briefing
        </button>
    </div>
</div>

<div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-10">Guest Identity</th>
                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Digital Contact</th>
                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">Protocol Date</th>
                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">Status</th>
                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right pr-10">Operations</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($customers as $customer)
                <tr class="group hover:bg-slate-50/50 transition-colors">
                    <!-- Guest Identity -->
                    <td class="px-8 py-6 pl-10">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-[#ad7e6c]/10 text-[#ad7e6c] flex items-center justify-center font-black text-sm group-hover:bg-[#ad7e6c] group-hover:text-white transition-all">
                                {{ substr($customer->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-800 tracking-tight">{{ $customer->name }}</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">ID: CS-USR-{{ str_pad($customer->id, 4, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                    </td>

                    <!-- Digital Contact -->
                    <td class="px-8 py-6">
                        <p class="text-xs font-black text-slate-900">{{ $customer->email }}</p>
                        <p class="text-[10px] items-center gap-1 inline-flex text-[#ad7e6c] font-black uppercase tracking-widest mt-1">
                            <span class="material-symbols-outlined text-[10px]">verified</span>
                            Verified Protocol
                        </p>
                    </td>

                    <!-- Protocol Date -->
                    <td class="px-8 py-6 text-center">
                        <span class="text-xs font-black text-slate-800 uppercase tracking-tighter">{{ $customer->created_at->format('d M, Y') }}</span>
                    </td>

                    <!-- Status – made extra visible with border & stronger shadow -->
                    <td class="px-8 py-6 text-center min-w-[120px] relative z-10">
    <span class="inline-flex items-center px-5 py-2 bg-[#ad7e6c] text-black rounded-xl text-xs font-black uppercase tracking-widest shadow-xl shadow-[#ad7e6c]/40 border border-white/20">
        {{ $customer->status ?? 'Active Node' }}
    </span>
</td>

                    <!-- Operations -->
                    <td class="px-8 py-6 text-right pr-12">
                        <div class="flex items-center justify-end gap-3 text-slate-400">
                            <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-black/10 border border-black/20 text-black hover:bg-black hover:text-white transition-all duration-300">
                                <span class="material-symbols-outlined text-sm">analytics</span>
                                <span class="text-[10px] font-black uppercase tracking-widest">Stats</span>
                            </button>
                            <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-black/10 border border-black/20 text-black hover:bg-black hover:text-white transition-all duration-300">
                                <span class="material-symbols-outlined text-sm">block</span>
                                <span class="text-[10px] font-black uppercase tracking-widest">Restrict</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-24 text-center">
                        <div class="flex flex-col items-center opacity-20">
                            <span class="material-symbols-outlined text-5xl mb-4">group_off</span>
                            <p class="text-xs font-bold uppercase tracking-[0.3em]">No Recorded Registrations</p>
                            @if(request('search'))
                                <a href="{{ route('admin.customers') }}" class="mt-4 text-[#ad7e6c] underline text-xs">Clear search</a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($customers->hasPages())
    <div class="px-10 py-6 border-t border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="text-xs text-slate-500">
            Showing {{ $customers->firstItem() }}–{{ $customers->lastItem() }} of {{ $customers->total() }} guests
        </div>
        <div class="flex items-center gap-4">
            <!-- Optional page size selector (you can add later) -->
            {{ $customers->withQueryString()->links() }}
        </div>
    </div>
    @endif
</div>
@endsection