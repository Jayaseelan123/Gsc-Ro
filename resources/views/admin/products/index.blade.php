@extends('layouts.admin')
@section('header', 'Products')
@section('content')
<div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Manage Products</h2>
    <a href="{{ route('admin.products.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-2.5 rounded-xl shadow-md flex items-center gap-2 transition-all duration-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Add New Product
    </a>
</div>

<!-- Search Section outside the card -->
<div class="mb-6 bg-white rounded-2xl shadow-sm border border-slate-100 p-4">
    <form action="{{ route('admin.products.index') }}" method="GET" class="flex items-center gap-3 w-full">
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" name="search" placeholder="Search products or categories..." value="{{ request('search') }}" class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition-all font-medium text-slate-900 bg-white">
        </div>

        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-2.5 rounded-xl flex items-center gap-2 transition-all duration-300 shrink-0">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            Search
        </button>

        <a href="{{ route('admin.products.index') }}" class="bg-white hover:bg-slate-50 text-slate-700 font-bold px-6 py-2.5 rounded-xl border border-slate-300 hover:border-slate-400 hover:text-slate-900 shadow-sm flex items-center gap-2 transition-all duration-300 shrink-0 active:bg-slate-100" title="Reset Search & Filters">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            Reset
        </a>
    </form>
</div>

<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden flex flex-col">
    <!-- Table -->
    <div class="overflow-x-auto">
        @if($products->count() > 0)
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-4 xl:px-5 2xl:px-8 py-5 text-sm font-extrabold text-slate-900 uppercase tracking-widest border-b border-slate-100 w-16">S.No</th>
                        <th class="px-4 xl:px-5 2xl:px-8 py-5 text-sm font-extrabold text-slate-900 uppercase tracking-widest border-b border-slate-100">Product Name</th>
                        <th class="px-4 xl:px-5 2xl:px-8 py-5 text-sm font-extrabold text-slate-900 uppercase tracking-widest border-b border-slate-100">Category</th>
                        <th class="px-4 xl:px-5 2xl:px-8 py-5 text-sm font-extrabold text-slate-900 uppercase tracking-widest border-b border-slate-100">Status</th>
                        <th class="px-4 xl:px-5 2xl:px-8 py-5 text-sm font-extrabold text-slate-900 uppercase tracking-widest border-b border-slate-100 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($products as $product)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-4 xl:px-5 2xl:px-8 py-4 whitespace-nowrap text-slate-600 font-bold">
                            {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-4 xl:px-5 2xl:px-8 py-4">
                            <div class="flex items-center gap-4 min-w-[200px]">
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-100 border border-slate-200 shrink-0">
                                    @if($product->main_image)
                                        @php
                                            $imgSrc = str_starts_with($product->main_image, 'http') ? $product->main_image : asset('storage/' . $product->main_image);
                                        @endphp
                                        <img src="{{ $imgSrc }}" alt="{{ $product->name }}" loading="lazy" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <div class="font-medium text-slate-900 text-lg break-words">{{ $product->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 xl:px-5 2xl:px-8 py-4">
                            <div class="font-medium text-slate-700 min-w-[110px] break-words">{{ $product->category->name ?? 'Uncategorized' }}</div>
                        </td>
                        <td class="px-4 xl:px-5 2xl:px-8 py-4 whitespace-nowrap">
                            <span class="px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg {{ $product->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $product->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 xl:px-5 2xl:px-8 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('admin.products.show', $product) }}" class="w-8 h-10 shrink-0 rounded-xl text-blue-600 flex items-center justify-center hover:text-blue-800 transition-colors" title="View Product" aria-label="View Product">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}" class="w-8 h-10 shrink-0 rounded-xl text-teal-600 flex items-center justify-center hover:text-teal-800 transition-colors" title="Edit Product" aria-label="Edit Product">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" data-confirm="Are you sure you want to delete this product?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-10 shrink-0 rounded-xl text-red-600 flex items-center justify-center hover:text-red-800 transition-colors" title="Delete" aria-label="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-16 text-center">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-400">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <h3 class="text-xl font-extrabold text-slate-900 mb-2">No Products Found</h3>
                <p class="text-slate-500 font-medium max-w-md mx-auto">You haven't added any products yet, or no products match your search criteria.</p>
                <a href="{{ route('admin.products.create') }}" class="inline-flex mt-6 bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-3 rounded-xl transition-all shadow-lg shadow-teal-600/30">
                    Add Your First Product
                </a>
            </div>
        @endif
    </div>

    @if($products->hasPages())
        <div class="p-6 border-t border-slate-100 bg-slate-50/50">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
