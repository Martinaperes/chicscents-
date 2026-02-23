@extends('layouts.admin')

@section('title', 'Inventory Management')
@section('page_title', 'Perfume Inventory')

@section('content')
@php
    $sortField = request('sort', 'name');
    $sortDirection = request('direction', 'asc');
    $oppositeDirection = $sortDirection === 'asc' ? 'desc' : 'asc';
@endphp

<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white p-8 rounded-3xl border border-slate-200 shadow-sm">

    <div>
        <h3 class="text-xl font-bold text-slate-800">Master Inventory</h3>
        <p class="text-xs text-slate-400">Manage your scent catalog and stock levels</p>
    </div>

    <div class="flex items-center gap-4">

        <!-- Add Fragrance Button -->
        <a href="{{ route('admin.products.create') }}"
           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl
                  border border-[#ad7e6c]
                  text-[#ad7e6c] font-bold text-xs uppercase tracking-widest
                  hover:bg-[#ad7e6c] hover:text-white
                  transition-all duration-200">

            <span class="material-symbols-outlined text-sm">add</span>
            Add Fragrance
        </a>

    </div>
</div>

<div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">

        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-8 py-5 text-xs font-bold uppercase text-slate-400">Fragrance</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase text-slate-400">Brand</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase text-slate-400 text-center">Stock</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase text-slate-400 text-right">Price</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase text-slate-400 text-center">Status</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase text-slate-400 text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($products as $product)
                <tr class="hover:bg-slate-50 transition">

                    <!-- Fragrance -->
                    <td class="px-8 py-6">
    <div class="flex items-center gap-6">

        <!-- Bigger Image -->
        <div class="w-20 h-20 rounded-2xl overflow-hidden 
                    border border-slate-200 bg-white shadow-sm
                    flex-shrink-0">

            @if($product->featured_image)
                <img src="{{ asset($product->featured_image) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover object-center">
            @else
                <div class="flex items-center justify-center w-full h-full text-slate-300">
                    <span class="material-symbols-outlined text-3xl">image</span>
                </div>
            @endif

        </div>

        <!-- Product Info -->
        <div>
            <p class="text-sm font-bold text-slate-800">
                {{ $product->name }}
            </p>
            <p class="text-xs text-slate-400">
                {{ $product->type ?? 'N/A' }} • {{ $product->volume ?? '0' }}ml
            </p>
        </div>

    </div>
</td>

                    <!-- Brand -->
                    <td class="px-8 py-6">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full
                                     bg-slate-100 text-slate-700
                                     text-xs font-semibold uppercase tracking-widest">
                            {{ $product->brand->name ?? 'Unbranded' }}
                        </span>
                    </td>

                    <!-- Stock -->
                    <td class="px-8 py-6 text-center">
                        <span class="text-sm font-bold
                            {{ $product->stock_quantity < 5 ? 'text-red-600' : 'text-slate-800' }}">
                            {{ $product->stock_quantity }}
                        </span>
                    </td>

                    <!-- Price -->
                    <td class="px-8 py-6 text-right">
                        <span class="text-sm font-bold text-slate-800">
                            Ksh {{ number_format($product->price, 2) }}
                        </span>
                    </td>

                    <!-- Status -->
                    <td class="px-8 py-6 text-center">
                        @if($product->is_active)
                            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full
                                         bg-emerald-100 text-emerald-700
                                         text-xs font-semibold uppercase tracking-widest">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full
                                         bg-rose-100 text-rose-700
                                         text-xs font-semibold uppercase tracking-widest">
                                <span class="w-2 h-2 bg-rose-500 rounded-full"></span>
                                Archived
                            </span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">

                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="px-4 py-2 rounded-lg border border-blue-500
                                      text-blue-500 text-xs font-semibold
                                      hover:bg-blue-500 hover:text-white transition">
                                Edit
                            </a>

                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to archive this fragrance?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="px-4 py-2 rounded-lg border border-red-500
                                           text-red-500 text-xs font-semibold
                                           hover:bg-red-500 hover:text-white transition">
                                    Archive
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-16 text-center text-slate-400">
                        No fragrances found.
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>

@endsection