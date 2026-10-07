@extends('layouts.admin')
@section('header', 'View Product')
@section('content')
@php
    $src = fn ($path) => str_starts_with((string) $path, 'http') ? $path : asset('storage/' . $path);

    // Main image first, then the extra images.
    $pictures = collect();
    if (filled($product->main_image)) {
        $pictures->push($src($product->main_image));
    }
    foreach ($product->images as $extra) {
        if (filled($extra->image)) {
            $pictures->push($src($extra->image));
        }
    }

    // "Label: value" lines become table rows; any other line spans the full row.
    $specRows = collect($product->specList())->map(function ($line) {
        return preg_match('/^([^:]{1,60}):\s*(.+)$/u', $line, $m)
            ? ['label' => trim($m[1]), 'value' => trim($m[2])]
            : ['label' => null, 'value' => $line];
    });

    $box = 'rounded-2xl bg-slate-50 border border-slate-100 px-4 py-3 min-w-0 flex flex-col justify-center';
    $dt = 'text-xs font-bold text-slate-500 uppercase tracking-wider';
    $dd = 'mt-1 text-base font-semibold text-slate-900 break-words';
@endphp

<!-- Header -->
<div class="mb-8 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
    <div class="flex items-center gap-4 min-w-0">
        <a href="{{ route('admin.products.index') }}" class="w-10 h-10 shrink-0 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-600 hover:border-teal-200 hover:bg-teal-50 transition-all shadow-sm" aria-label="Back to products">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div class="min-w-0">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Product Details</h2>
            <p class="text-slate-500 font-medium mt-1 truncate">{{ $product->name }}</p>
        </div>
    </div>

    <div class="flex flex-wrap items-center gap-3">
        @if($product->status)
            <a href="{{ route('product.details', $product->slug) }}" target="_blank" rel="noopener" class="bg-white border border-slate-200 hover:border-teal-300 hover:text-teal-700 text-slate-700 font-bold px-4 py-2.5 rounded-xl transition-all shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                View on Website
            </a>
        @endif
        <a href="{{ route('admin.products.edit', $product) }}" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-4 py-2.5 rounded-xl transition-all shadow-md flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            Edit
        </a>
        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" data-confirm="Are you sure you want to delete this product?">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-50 hover:bg-red-600 text-red-600 hover:text-white font-bold px-4 py-2.5 rounded-xl transition-all shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Delete
            </button>
        </form>
    </div>
</div>

<div class="space-y-6 lg:space-y-8">
    <!-- Row 1: images beside the key details (equal height) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 items-stretch">
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 min-w-0 h-full" x-data="{ current: @js($pictures->first()) }">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Images ({{ $pictures->count() }})</h3>
            <div class="h-60 xl:h-64 rounded-2xl bg-slate-50 border border-slate-100 overflow-hidden flex items-center justify-center">
                @if($pictures->isNotEmpty())
                    <a :href="current" href="{{ $pictures->first() }}" target="_blank" rel="noopener" class="block w-full h-full p-3" title="Open full size">
                        <img :src="current" src="{{ $pictures->first() }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                    </a>
                @else
                    <div class="flex flex-col items-center text-slate-300">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="mt-2 text-xs font-bold uppercase tracking-wider text-slate-400">No image</span>
                    </div>
                @endif
            </div>
            @if($pictures->count() > 1)
                <div class="mt-3 grid grid-cols-5 gap-2">
                    @foreach($pictures as $i => $pic)
                        <button type="button" @click="current = @js($pic)" class="aspect-square rounded-xl overflow-hidden bg-slate-50 border-2 transition-colors"
                                :class="current === @js($pic) ? 'border-teal-500' : 'border-slate-100 hover:border-slate-300'" aria-label="Show image {{ $i + 1 }}">
                            <img src="{{ $pic }}" alt="" loading="lazy" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
                <p class="mt-3 text-xs font-medium text-slate-500">The first image is the main product image. Click the large image to open it full size.</p>
            @endif
        </div>

        <div class="lg:col-span-2 bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 sm:p-8 min-w-0 h-full flex flex-col">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Product Information</h3>
            <dl class="flex-1 grid grid-cols-1 sm:grid-cols-2 auto-rows-fr gap-3">
                <div class="{{ $box }} sm:col-span-2">
                    <dt class="{{ $dt }}">Product Name</dt>
                    <dd class="{{ $dd }}">{{ $product->name }}</dd>
                </div>
                <div class="{{ $box }}">
                    <dt class="{{ $dt }}">Category</dt>
                    <dd class="{{ $dd }}">{{ $product->category->name ?? 'Uncategorized' }}</dd>
                </div>
                <div class="{{ $box }}">
                    <dt class="{{ $dt }}">Price</dt>
                    <dd class="{{ $dd }} {{ $product->price ? 'text-teal-700' : '' }}">{{ $product->price ? '₹' . number_format($product->price, 2) : 'POA (price on request)' }}</dd>
                </div>
                <div class="{{ $box }}">
                    <dt class="{{ $dt }}">Status</dt>
                    <dd class="mt-1.5"><span class="inline-block px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-lg {{ $product->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ $product->status ? 'Active' : 'Inactive' }}</span></dd>
                </div>
                <div class="{{ $box }}">
                    <dt class="{{ $dt }}">Featured</dt>
                    <dd class="mt-1.5">
                        @if($product->featured)
                            <span class="inline-block px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-lg bg-yellow-100 text-yellow-700">Featured</span>
                        @else
                            <span class="text-base font-semibold text-slate-500">No</span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Row 2: descriptions -->
    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 sm:p-8 space-y-6">
        <div>
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Short Description</h3>
            @if(filled($product->short_description))
                <p class="text-slate-700 leading-relaxed whitespace-pre-line break-words">{{ trim($product->short_description) }}</p>
            @else
                <p class="text-slate-400 italic">No short description added.</p>
            @endif
        </div>
        <div class="pt-6 border-t border-slate-100">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Description</h3>
            @if(filled($product->description))
                <p class="text-slate-700 leading-relaxed whitespace-pre-line break-words">{{ trim($product->description) }}</p>
            @else
                <p class="text-slate-400 italic">No description added.</p>
            @endif
        </div>
    </div>

    <!-- Row 3: specifications -->
    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 sm:p-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Specifications</h3>
            @if($product->spec_sheet)
                <a href="{{ asset('storage/' . $product->spec_sheet) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm text-teal-700 hover:text-white hover:bg-teal-600 font-bold bg-teal-50 px-4 py-2 rounded-xl transition-colors self-start">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Spec Sheet (PDF)
                </a>
            @endif
        </div>
        @if($specRows->isNotEmpty())
            <div class="rounded-2xl border border-slate-100 overflow-hidden">
                <table class="w-full text-left">
                    <tbody class="divide-y divide-slate-100">
                        @foreach($specRows as $row)
                            <tr class="{{ $loop->even ? 'bg-slate-50/60' : 'bg-white' }}">
                                @if($row['label'])
                                    <th scope="row" class="w-2/5 px-4 py-3 text-sm font-bold text-slate-500 align-top break-words">{{ $row['label'] }}</th>
                                    <td class="px-4 py-3 text-sm font-semibold text-slate-900 break-words">{{ $row['value'] }}</td>
                                @else
                                    <td colspan="2" class="px-4 py-3 text-sm font-semibold text-slate-900 break-words">{{ $row['value'] }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-slate-400 italic">No specifications added.</p>
        @endif
    </div>
</div>
@endsection
