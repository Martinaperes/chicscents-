@extends('layouts.admin')

@section('title', 'Brand Management')
@section('page_title', 'Perfume Houses')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden">
    
    <!-- Decorative Circle Background -->
    <div class="absolute top-0 right-0 w-32 h-32 bg-adm-accent/5 rounded-full -mr-16 -mt-16 blur-3xl z-0"></div>

    <!-- Title Section -->
    <div class="relative z-10">
        <h3 class="text-lg font-bold text-slate-800">Perfume Houses</h3>
        <p class="text-xs text-slate-400">Total registered brands: {{ $brands->total() }}</p>
    </div>

    <!-- Add Brand Button -->
    <div class="flex items-center gap-4 mt-4 md:mt-0 relative z-10">
        <a href="{{ route('admin.brands.create') }}" 
           class="inline-flex items-center gap-3 bg-adm-accent text-slate-50 px-8 py-4 rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] hover:bg-adm-dark hover:text-white hover:shadow-2xl transition-all duration-300 active:scale-95 group">
            <span class="material-symbols-outlined text-sm group-hover:rotate-180 transition-transform duration-500">add</span>
            Add Brand
        </a>
    </div>
</div>

<!-- Brands Table -->
<div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden min-h-[400px]">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/80 border-b border-slate-100">
                    <th class="px-10 py-6 text-[11px] font-black text-slate-400 uppercase tracking-widest">Heritage House</th>
                    <th class="px-10 py-6 text-[11px] font-black text-slate-400 uppercase tracking-widest">Operational Narrative</th>
                    <th class="px-10 py-6 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">Active Assets</th>
                    <th class="px-10 py-6 text-[11px] font-black text-slate-400 uppercase tracking-widest text-right pr-12">Operations</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($brands as $brand)
                <tr class="group hover:bg-ivory/50 transition-colors">
                    <!-- Logo & Name -->
                    <td class="px-10 py-8 pl-12">
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center overflow-hidden border border-slate-200 shadow-sm group-hover:scale-110 transition-transform duration-500">
                                @if($brand->logo)
                                    <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }} Logo" class="w-full h-full object-cover">
                                @else
                                    <span class="font-black text-white text-lg bg-slate-900 w-full h-full flex items-center justify-center">{{ substr($brand->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <span class="font-black text-slate-900 tracking-tight text-base">{{ $brand->name }}</span>
                        </div>
                    </td>

                    <!-- Description -->
                    <td class="px-8 py-6">
                        <p class="text-xs font-medium text-slate-500 max-w-sm truncate">{{ $brand->description ?: 'No operational description provided.' }}</p>
                    </td>

                    <!-- Perfume Count -->
                    <td class="px-8 py-6 text-center">
                        <span class="px-4 py-1.5 bg-adm-accent/10 text-adm-accent border border-adm-accent/20 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm">{{ $brand->perfumes_count ?? 0 }} Units</span>
                    </td>

                    <!-- Operations -->
                    <td class="px-8 py-6 text-right pr-12">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.brands.edit', $brand->id) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-adm-accent/10 border border-adm-accent/20 text-adm-accent hover:bg-adm-accent hover:text-white transition-all duration-300">
                                <span class="material-symbols-outlined text-sm">edit</span>
                                <span class="text-[10px] font-black uppercase tracking-widest">Edit</span>
                            </a>
                            <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('Deleting a brand cannot be undone. Proceed?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-adm-error/10 border border-adm-error/20 text-adm-error hover:bg-adm-error hover:text-white transition-all duration-300">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                    <span class="text-[10px] font-black uppercase tracking-widest">Remove</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-24 text-center">
                        <div class="flex flex-col items-center opacity-20">
                            <span class="material-symbols-outlined text-5xl mb-4">diamond</span>
                            <p class="text-xs font-bold uppercase tracking-[0.3em]">No Heritage Houses Registered</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($brands->hasPages())
    <div class="px-8 py-6 border-t border-slate-100 bg-slate-50/50">
        {{ $brands->links() }}
    </div>
    @endif
</div>
@endsection