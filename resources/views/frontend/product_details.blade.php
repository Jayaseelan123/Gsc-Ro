@extends('layouts.frontend')
@section('title', $product->name)
@section('content')
@php
    $images = $product->galleryUrls();
    $specs = $product->specList();
    $summary = trim((string) $product->short_description);

    $phone = preg_replace('/[^0-9+]/', '', $settings['phone'] ?? '');
    $whatsapp = preg_replace('/[^0-9]/', '', ($settings['whatsapp'] ?? '') ?: ($settings['phone'] ?? ''));
    $whatsappText = rawurlencode('Hello, I would like to know the price of "' . $product->name . '". ' . route('product.details', $product->slug));
    $buttonCount = 1 + ($phone !== '' ? 1 : 0) + ($whatsapp !== '' ? 1 : 0);
    $buttonCols = $buttonCount === 1 ? 'sm:grid-cols-1' : 'sm:grid-cols-2';
    $downloadSpan = $buttonCount === 3 ? 'sm:col-span-2' : '';
@endphp

@include('frontend.partials.page-hero', [
    'eyebrow' => $product->category->name ?? 'Product',
    'title' => $product->name,
    'breadcrumbs' => array_values(array_filter([
        ['Home', route('home')],
        ['Products', route('products')],
        $product->category ? [$product->category->name, route('products.category', $product->category->slug)] : null,
        [$product->name, null],
    ])),
])

<section id="product-print" class="bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-10">
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
            <div class="flex flex-col lg:flex-row items-stretch">

                <!-- LEFT: Image gallery -->
                <div class="lg:w-1/2 p-5 sm:p-6 lg:p-8 bg-slate-50 border-b lg:border-b-0 lg:border-r border-slate-200 flex flex-col items-center justify-center">
                    <div class="w-full min-h-[200px] flex items-center justify-center">
                        @if(count($images))
                            <img id="main-product-image" src="{{ $images[0] }}" alt="{{ $product->name }}" class="max-w-full max-h-[300px] lg:max-h-[340px] w-auto h-auto object-contain drop-shadow-xl rounded-lg transition-opacity duration-300">
                        @else
                            <div class="flex flex-col items-center justify-center text-slate-300 text-center">
                                <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="mt-3 text-sm font-bold uppercase tracking-widest text-slate-400">Image coming soon</span>
                            </div>
                        @endif
                    </div>

                    @if(count($images) > 1)
                        <div class="mt-5 w-full flex flex-wrap justify-center gap-2 print:hidden" role="list" aria-label="Product images">
                            @foreach($images as $i => $url)
                                <button type="button" role="listitem" data-thumb="{{ $url }}" aria-label="Show image {{ $i + 1 }} of {{ count($images) }}" aria-pressed="{{ $i === 0 ? 'true' : 'false' }}"
                                    class="product-thumb w-14 h-14 sm:w-16 sm:h-16 shrink-0 bg-white rounded-xl border-2 p-1 overflow-hidden transition-all focus:outline-none focus-visible:ring-4 focus-visible:ring-teal-200 {{ $i === 0 ? 'border-teal-600 shadow-md' : 'border-slate-200 hover:border-teal-300' }}">
                                    <img src="{{ $url }}" alt="{{ $product->name }} image {{ $i + 1 }}" loading="lazy" class="w-full h-full object-contain">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- RIGHT: Product information -->
                <div class="lg:w-1/2 p-5 sm:p-6 lg:p-8 flex flex-col justify-center min-w-0">
                    <div class="mb-3 flex flex-wrap gap-2">
                        @if($product->category)
                            <a href="{{ route('products.category', $product->category->slug) }}" class="inline-block px-3 py-1 rounded-full bg-teal-50 text-teal-700 text-[11px] font-bold uppercase tracking-widest border border-teal-100 hover:bg-teal-100 transition-colors">{{ $product->category->name }}</a>
                        @endif
                        @if($product->featured)
                            <span class="inline-block px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-[11px] font-bold uppercase tracking-widest border border-amber-100">Featured</span>
                        @endif
                    </div>

                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-3 tracking-tight leading-tight break-words">{{ $product->name }}</h2>

                    @if($product->price)
                        <div class="flex flex-wrap items-end gap-2 mb-4">
                            <span class="text-2xl sm:text-3xl font-black text-slate-900">₹{{ number_format($product->price, 2) }}</span>
                            <span class="text-slate-500 font-bold mb-1 border-b-2 border-slate-300 pb-0.5 uppercase tracking-wider text-xs">INR</span>
                        </div>
                    @endif

                    @if(filled($summary))
                        <p class="text-base text-slate-600 leading-relaxed mb-5">{{ $summary }}</p>
                    @endif

                    @if(count($specs))
                        <div class="mb-5 bg-slate-50 rounded-2xl border border-slate-200 px-5 py-4">
                            <h2 class="text-xs font-extrabold text-slate-900 uppercase tracking-widest mb-3">Specifications</h2>
                            <ul class="space-y-1.5">
                                @foreach($specs as $spec)
                                    <li class="flex items-start gap-2.5 text-sm sm:text-base text-slate-700 leading-relaxed">
                                        <span class="mt-2 w-1.5 h-1.5 shrink-0 rounded-full bg-teal-600"></span>
                                        <span class="break-words min-w-0">{{ $spec }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Pricing / contact -->
                    <div class="pt-5 border-t border-slate-100">
                        <h2 class="text-base font-extrabold text-slate-900">Contact Us for Pricing</h2>
                        <p class="mt-0.5 mb-3 text-sm text-slate-500 font-medium">Get a quote for your quantity and requirements.</p>


                        <div class="grid grid-cols-1 {{ $buttonCols }} gap-3 print:hidden">
                        @if($phone !== '')
                            <a href="tel:{{ $phone }}" class="inline-flex items-center justify-center gap-2 bg-teal-600 hover:bg-teal-500 text-white font-bold px-4 py-2.5 rounded-xl whitespace-nowrap transition-colors">
                                <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z"/></svg>
                                Call
                            </a>
                        @endif
                        @if($whatsapp !== '')
                            <a href="https://wa.me/{{ $whatsapp }}?text={{ $whatsappText }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#1ebe5b] text-white font-bold px-4 py-2.5 rounded-xl whitespace-nowrap transition-colors">
                                <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                WhatsApp
                            </a>
                        @endif
                        @php $downloadIcon = '<svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>'; @endphp
                        @if($product->spec_sheet)
                            <a href="{{ asset('storage/' . $product->spec_sheet) }}" download="{{ $product->slug }}-specifications.pdf" class="inline-flex items-center justify-center gap-2 bg-white hover:bg-slate-50 text-slate-800 border-2 border-slate-200 hover:border-slate-300 font-bold px-4 py-2.5 rounded-xl whitespace-nowrap transition-colors {{ $downloadSpan }}">
                                {!! $downloadIcon !!} Download Specs
                            </a>
                        @else
                            <button type="button" onclick="window.print()" class="inline-flex items-center justify-center gap-2 bg-white hover:bg-slate-50 text-slate-800 border-2 border-slate-200 hover:border-slate-300 font-bold px-4 py-2.5 rounded-xl whitespace-nowrap transition-colors {{ $downloadSpan }}" title="Opens a print-ready spec sheet you can save as PDF">
                                {!! $downloadIcon !!} Download Specs
                            </button>
                        @endif
                        </div>
                        <p class="text-center text-xs text-slate-500 mt-3 font-medium uppercase tracking-wider">We typically respond within 24 hours.</p>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>

<style>
    @media print {
        body * { visibility: hidden; }
        #product-print, #product-print * { visibility: visible; }
        #product-print { position: absolute; inset: 0 auto auto 0; width: 100%; background: #fff !important; }
    }
</style>

@if(count($images) > 1)
<script>
    (function () {
        const main = document.getElementById('main-product-image');
        const thumbs = document.querySelectorAll('.product-thumb');
        thumbs.forEach(function (thumb) {
            thumb.addEventListener('click', function () {
                if (main.src === thumb.dataset.thumb) return;
                main.style.opacity = '0';
                setTimeout(function () {
                    main.src = thumb.dataset.thumb;
                    main.style.opacity = '1';
                }, 150);
                thumbs.forEach(function (t) {
                    const active = t === thumb;
                    t.setAttribute('aria-pressed', active ? 'true' : 'false');
                    t.classList.toggle('border-teal-600', active);
                    t.classList.toggle('shadow-md', active);
                    t.classList.toggle('border-slate-200', !active);
                });
            });
        });
    })();
</script>
@endif
@endsection
