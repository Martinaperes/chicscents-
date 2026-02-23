@extends('layouts.admin')

@section('title', 'Add New Brand')
@section('page_title', 'Register Brand')

@section('content')
<div class="mb-10">
    <a href="{{ route('admin.brands') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-adm-accent transition-all uppercase tracking-widest">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Return to Collections
    </a>
</div>

<div class="max-w-2xl bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 ">
    
    <!-- Header -->
    <div class="px-10 py-8 border-b border-slate-100 bg-slate-50/50">
        <h3 class="text-xl font-bold text-slate-800">New Fragrance House</h3>
        <p class="text-xs text-slate-400">Register a new designer or niche perfume brand</p>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.brands.store') }}" method="POST" class="p-10 space-y-8">
        @csrf

        <!-- Error Messages -->
        @if($errors->any())
            <div class="p-6 bg-adm-error/5 border border-adm-error/10 rounded-2xl">
                <p class="text-[10px] font-bold text-adm-error uppercase tracking-widest mb-2">Required Correction:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li class="text-xs text-adm-error/80 font-medium">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Input Fields -->
        <div class="space-y-6">
            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3 pl-1">Brand Identity</label>
                <input type="text" name="name" required value="{{ old('name') }}" placeholder="e.g. Maison Francis Kurkdjian"
                    class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3 pl-1">Heritage / Narrative</label>
                <textarea name="description" rows="5" placeholder="Describe the history and aesthetic of this house..."
                    class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all">{{ old('description') }}</textarea>
            </div>
        </div>

        <!-- Submit Button -->
<div class="pt-4">
    <button type="submit"
        class="w-full bg-[#ad7e6c] text-black py-5 rounded-2xl text-sm font-bold uppercase tracking-[0.2em] shadow-lg shadow-[#ad7e6c]/50 hover:bg-[#8c654e] hover:scale-[1.02] active:scale-[0.98] transition-all duration-300">
        Register House
    </button>
</div>
    </form>
</div>
@endsection