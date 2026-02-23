@extends('layouts.admin')

@section('title', 'Update Scent: ' . $product->name)
@section('page_title', 'Modify Fragrance')

@section('content')
<div class="mb-10">
    <a href="{{ route('admin.products') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-adm-accent transition-all uppercase tracking-widest">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Return to Master Inventory
    </a>
</div>

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    @if($errors->any())
        <div class="mb-8 p-6 bg-adm-error/5 border border-adm-error/10 rounded-2xl animate-in fade-in slide-in-from-top-4">
            <p class="text-[10px] uppercase font-bold text-adm-error mb-2 tracking-widest">Required Correction:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li class="text-xs text-adm-error/80 font-medium">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <!-- Core Details -->
            <div class="bg-white p-10 rounded-3xl border border-slate-200 shadow-sm">
                <div class="flex items-center gap-3 mb-8 pb-6 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-xl bg-adm-accent/10 text-adm-accent flex items-center justify-center">
                        <span class="material-symbols-outlined">edit_note</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800">Essential Data</h4>
                        <p class="text-xs text-slate-400">Modify core information for this scent</p>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Fragrance Name</label>
                            <input type="text" name="name" required value="{{ old('name', $product->name) }}" placeholder="e.g. Baccarat Rouge 540"
                                class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Brief Highlight</label>
                            <input type="text" name="short_description" value="{{ old('short_description', $product->short_description) }}" placeholder="e.g. A sophisticated woody oriental scent"
                                class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Brand / House</label>
                            <select name="brand_id" class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all appearance-none cursor-pointer">
                                <option value="">Select House</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Global SKU</label>
                            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" placeholder="CS-BR-540"
                                class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Concentration</label>
                            <select name="concentration" class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all appearance-none cursor-pointer">
                                <option value="Eau de Parfum" {{ old('concentration', $product->concentration) == 'Eau de Parfum' ? 'selected' : '' }}>Eau de Parfum</option>
                                <option value="Parfum" {{ old('concentration', $product->concentration) == 'Parfum' ? 'selected' : '' }}>Extrait de Parfum</option>
                                <option value="Eau de Toilette" {{ old('concentration', $product->concentration) == 'Eau de Toilette' ? 'selected' : '' }}>Eau de Toilette</option>
                                <option value="Eau de Cologne" {{ old('concentration', $product->concentration) == 'Eau de Cologne' ? 'selected' : '' }}>Eau de Cologne</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Liquid Volume (ML)</label>
                            <input type="number" name="volume" value="{{ old('volume', $product->volume) }}" placeholder="100"
                                class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Product Narrative</label>
                        <textarea name="description" rows="6" placeholder="Describe the scent profile and notes..."
                            class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Scent Profile -->
            <div class="bg-white p-10 rounded-3xl border border-slate-200 shadow-sm">
                <div class="flex items-center gap-3 mb-8 pb-6 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-xl bg-adm-info/10 text-adm-info flex items-center justify-center">
                        <span class="material-symbols-outlined">psychology</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800">Olfactory Profile</h4>
                        <p class="text-xs text-slate-400">Update scent notes and performance metrics</p>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Top Notes</label>
                            <input type="text" name="top_notes" value="{{ old('top_notes', $product->top_notes) }}" placeholder="Saffron, Jasmine"
                                class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Heart Notes</label>
                            <input type="text" name="heart_notes" value="{{ old('heart_notes', $product->heart_notes) }}" placeholder="Amberwood, Ambergris"
                                class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Base Notes</label>
                            <input type="text" name="base_notes" value="{{ old('base_notes', $product->base_notes) }}" placeholder="Fir Resin, Cedar"
                                class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Longevity</label>
                            <select name="longevity" class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all appearance-none cursor-pointer">
                                <option value="Weak" {{ old('longevity', $product->longevity) == 'Weak' ? 'selected' : '' }}>Weak (1-2h)</option>
                                <option value="Moderate" {{ old('longevity', $product->longevity) == 'Moderate' || !$product->longevity ? 'selected' : '' }}>Moderate (3-6h)</option>
                                <option value="Long Lasting" {{ old('longevity', $product->longevity) == 'Long Lasting' ? 'selected' : '' }}>Long Lasting (7-12h)</option>
                                <option value="Eternal" {{ old('longevity', $product->longevity) == 'Eternal' ? 'selected' : '' }}>Eternal (12h+)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Sillage / Projection</label>
                            <select name="sillage" class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all appearance-none cursor-pointer">
                                <option value="Intimate" {{ old('sillage', $product->sillage) == 'Intimate' ? 'selected' : '' }}>Intimate</option>
                                <option value="Moderate" {{ old('sillage', $product->sillage) == 'Moderate' || !$product->sillage ? 'selected' : '' }}>Moderate</option>
                                <option value="Strong" {{ old('sillage', $product->sillage) == 'Strong' ? 'selected' : '' }}>Strong</option>
                                <option value="Enormous" {{ old('sillage', $product->sillage) == 'Enormous' ? 'selected' : '' }}>Enormous</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing & Inventory -->
            <div class="bg-white p-10 rounded-3xl border border-slate-200 shadow-sm">
                <div class="flex items-center gap-3 mb-8 pb-6 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-xl bg-adm-success/10 text-adm-success flex items-center justify-center">
                        <span class="material-symbols-outlined">analytics</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800">Financials & Allocation</h4>
                        <p class="text-xs text-slate-400">Update prices and current stock levels</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3 text-center">Standard Price</label>
                        <div class="relative">
                            <span class="absolute left-6 top-4 text-slate-400 text-sm font-bold">Ksh</span>
                            <input type="number" name="price" required value="{{ old('price', $product->price) }}" placeholder="0.00"
                                class="w-full bg-slate-50 border-slate-200 rounded-2xl pl-16 pr-6 py-4 text-sm font-bold text-slate-800 focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3 text-center">Decant Price</label>
                        <div class="relative">
                            <span class="absolute left-6 top-4 text-slate-400 text-sm font-bold">Ksh</span>
                            <input type="number" name="decant_price" value="{{ old('decant_price', $product->decant_price) }}" placeholder="0.00"
                                class="w-full bg-slate-50 border-slate-200 rounded-2xl pl-16 pr-6 py-4 text-sm font-bold text-slate-800 focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3 text-center">Current Stock</label>
                        <input type="number" name="stock_quantity" required value="{{ old('stock_quantity', $product->stock_quantity) }}" placeholder="0"
                            class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all text-center">
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <!-- Media Upload -->
            <div class="bg-white p-10 rounded-3xl border border-slate-200 shadow-sm">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-adm-warning/10 text-adm-warning flex items-center justify-center">
                        <span class="material-symbols-outlined">image</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800">Visuals</h4>
                        <p class="text-xs text-slate-400">Current product view</p>
                    </div>
                </div>
                
                <div class="space-y-6">
                    @if($product->featured_image)
                        <div class="relative w-full aspect-square bg-slate-50 rounded-2xl overflow-hidden mb-4 border border-slate-100 group">
                            <img src="{{ asset($product->featured_image) }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-adm-dark/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <p class="text-white text-[10px] font-bold uppercase tracking-widest">Active Look</p>
                            </div>
                        </div>
                    @endif

                    <div class="border-2 border-dashed border-slate-200 rounded-3xl p-8 text-center bg-slate-50/50 hover:bg-white hover:border-adm-accent transition-all group cursor-pointer" onclick="document.getElementById('featured_image').click()">
                        <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl text-slate-300 group-hover:text-adm-accent">add_photo_alternate</span>
                        </div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-slate-800">Replace Image</p>
                        <p class="text-[9px] text-slate-300 mt-2">JPG, PNG, or WEBP (Max 2MB)</p>
                        <input type="file" name="featured_image" class="hidden" id="featured_image">
                    </div>
                </div>
            </div>

            <!-- Classification -->
            <div class="bg-white p-10 rounded-3xl border border-slate-200 shadow-sm">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center">
                        <span class="material-symbols-outlined">label_important</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800">Taxonomy</h4>
                        <p class="text-xs text-slate-400">Classify your product</p>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Genre / Type</label>
                        <select name="type" class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all appearance-none cursor-pointer">
                            <option value="luxury" {{ old('type', $product->type) == 'luxury' ? 'selected' : '' }}>Luxury Range</option>
                            <option value="niche" {{ old('type', $product->type) == 'niche' ? 'selected' : '' }}>Heritage / Niche</option>
                            <option value="designer" {{ old('type', $product->type) == 'designer' ? 'selected' : '' }}>Designer Series</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Gender Target</label>
                        <select name="gender" class="w-full bg-slate-50 border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-adm-accent/10 focus:border-adm-accent focus:bg-white transition-all appearance-none cursor-pointer">
                            <option value="Unisex" {{ old('gender', $product->gender) == 'Unisex' ? 'selected' : '' }}>Genderless / Unisex</option>
                            <option value="Male" {{ old('gender', $product->gender) == 'Male' ? 'selected' : '' }}>Masculine / Pour Homme</option>
                            <option value="Female" {{ old('gender', $product->gender) == 'Female' ? 'selected' : '' }}>Feminine / Pour Femme</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-adm-accent text-black py-6 rounded-3xl text-sm font-bold uppercase tracking-[0.3em] shadow-xl shadow-adm-accent/30 hover:bg-adm-dark hover:scale-[1.02] active:scale-[0.98] transition-all duration-300">
                    Update Collection
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
