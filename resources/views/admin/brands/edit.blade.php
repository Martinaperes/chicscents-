@extends('layouts.admin')

@section('title', 'Edit Brand')
@section('page_title', 'Update House')

@section('content')
<div class="mb-10">
    <a href="{{ route('admin.brands') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-adm-accent transition-all uppercase tracking-widest">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Return to Collections
    </a>
</div>

<div class="max-w-2xl bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden">
    <div class="px-10 py-8 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Modify Identity</h3>
            <p class="text-xs text-slate-400">Updating details for: <span class="text-adm-accent font-bold">{{ $brand->name }}</span></p>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-adm-accent/10 flex items-center justify-center text-adm-accent font-bold">
            {{ substr($brand->name, 0, 1) }}
        </div>
    </div>

    <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" class="p-10 space-y-8">
        @csrf
        @method('PUT')
        
        @if($errors->any())
            <div class="p-6 bg-adm-error/5 border border-adm-error/10 rounded-2xl">
                <p class="text-[10px] uppercase font-bold text-adm-error mb-2 tracking-widest">Required Correction:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li class="text-xs text-adm-error/80 font-medium">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="space-y-6">
            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3 pl-1">Brand Name</label>
                <input type="text" name="name" required value="{{ old('name', $brand->name) }}"
                    class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3 pl-1">Heritage / Narrative</label>
                <textarea name="description" rows="5"
                    class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all">{{ old('description', $brand->description) }}</textarea>
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-adm-accent text-black py-5 rounded-2xl text-sm font-bold uppercase tracking-[0.2em] shadow-xl shadow-adm-accent/20 hover:bg-adm-dark hover:scale-[1.01] active:scale-[0.98] transition-all duration-300">
                Commit Changes
            </button>
        </div>
    </form>
</div>
@endsection
