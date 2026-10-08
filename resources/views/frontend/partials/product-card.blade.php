{{--
    Shared product card (home featured products, category pages).
    @param \App\Models\Product $product
    @param bool                $showCategory  show the category label (default true)
--}}
@php
    $showCategory = $showCategory ?? true;
    $url = route('product.details', $product->slug);
    $image = $product->main_image
        ? (str_starts_with($product->main_image, 'http') ? $product->main_image : asset('storage/' . $product->main_image))
        : null;
@endphp
<div class="group h-full bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl hover:border-brand-200 hover:-translate-y-1 transition-all duration-300 flex flex-col">
    <a href="{{ $url }}" class="relative block aspect-[4/3] bg-slate-50 border-b border-slate-100 overflow-hidden" tabindex="-1" aria-hidden="true">
        @if($image)
            <img src="{{ $image }}" alt="{{ $product->name }}" loading="lazy" class="absolute inset-0 w-full h-full object-contain p-5 group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="absolute inset-0 flex flex-col items-center justify-center text-slate-300">
                <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span class="mt-2 text-xs font-bold uppercase tracking-widest text-slate-400">Image coming soon</span>
            </div>
        @endif
        @if($product->featured)
            <span class="absolute top-3 right-3 px-2.5 py-1 bg-amber-400 text-amber-950 text-[10px] font-extrabold rounded-full shadow-sm uppercase tracking-wider">Featured</span>
        @endif
    </a>

    <div class="p-5 flex-1 flex flex-col">
        @if($showCategory && $product->category)
            <span class="text-[11px] font-bold uppercase tracking-widest text-brand-600 mb-1.5 truncate">{{ $product->category->name }}</span>
        @endif
        <h3 class="text-base font-bold text-slate-900 leading-snug line-clamp-2 min-h-[2.75rem]">
            <a href="{{ $url }}" class="hover:text-brand-600 transition-colors">{{ $product->name }}</a>
        </h3>
        <p class="mt-2 text-sm text-slate-500 leading-relaxed line-clamp-2 min-h-[2.5rem]">{{ $product->short_description }}</p>

        <div class="mt-auto pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
            <a href="{{ $url }}" class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-brand-50 text-brand-700 text-sm font-bold hover:bg-brand-600 hover:text-white transition-colors">
                View
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </div>
</div>
