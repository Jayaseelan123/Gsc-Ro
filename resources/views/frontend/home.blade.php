@extends('layouts.frontend')
@section('title', 'Pure & Safe Drinking Water Solutions')
@section('content')
@php
    $benefits = [
        ['Advanced Filtration', 'Multi-stage purification that removes dissolved impurities, sediment and harmful microorganisms.', 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
        ['Pure & Safe Water', 'Clean, great-tasting water for drinking and cooking, every day.', 'M12 21a7 7 0 01-7-7c0-3.866 7-11 7-11s7 7.134 7 11a7 7 0 01-7 7z'],
        ['Quality Products', 'Filters and systems built with dependable components for long service life.', 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
        ['Reliable Performance', 'Consistent output you can count on for homes, offices and businesses.', 'M13 10V3L4 14h7v7l9-11h-7z'],
        ['Easy Maintenance', 'Simple filter replacement and straightforward servicing to keep water quality high.', 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065zM15 12a3 3 0 11-6 0 3 3 0 016 0z'],
        ['Customer Support', 'Guidance before you buy and dependable help after installation.', 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z'],
    ];

    $solutions = [
        ['RO Purification', 'Reverse osmosis reduces dissolved salts (TDS) and heavy metals, making it suitable for borewell and hard water.', 'M12 21a7 7 0 01-7-7c0-3.866 7-11 7-11s7 7.134 7 11a7 7 0 01-7 7z'],
        ['UV Disinfection', 'Ultraviolet treatment neutralises bacteria and viruses without adding chemicals to your water.', 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z'],
        ['UF Filtration', 'Ultrafiltration removes suspended particles and microorganisms while retaining essential minerals.', 'M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z'],
        ['Water Softening', 'Softeners reduce hardness to help prevent scale on taps, pipes, heaters and appliances.', 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
        ['Commercial & Industrial Plants', 'Higher-capacity treatment systems for offices, schools, hospitals, hotels and factories.', 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
        ['Water Testing & Guidance', 'We help you understand your water source so you choose the right purification method.', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
    ];

    $trust = [
        ['Product Quality', 'Every system is selected and checked for dependable build quality before it reaches you.'],
        ['Filtration Efficiency', 'The right technology for your water source, so you get effective purification without over-treating.'],
        ['Durability', 'Robust components designed for everyday use in homes and demanding commercial settings.'],
        ['Customer Trust', 'Honest recommendations, clear quotations and support that continues after installation.'],
    ];

    $processSteps = [
        ['Share Your Requirement', 'Tell us what you need through our requirement form, a call or WhatsApp.', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
        ['Consultation & Review', 'Our team studies your water source and needs and, where needed, visits your site.', 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
        ['Custom Quotation', 'You receive a clear, itemised quote with pricing and delivery timelines.', 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z'],
        ['Delivery & Support', 'We install on schedule and stay available for after-sales service.', 'M5 13l4 4L19 7'],
    ];

    $homeCategories = [
        ['Domestic Water Treatment Plants', 'Compact RO purifiers that give your family safe, great-tasting drinking water at home.', 'https://images.unsplash.com/photo-1559839914-17aae19cec71?q=80&w=800&auto=format&fit=crop', 'Glass and bottle of clean drinking water'],
        ['Industrial Water Treatment Plants', 'High-capacity treatment plants for factories, institutions and commercial sites.', 'https://images.unsplash.com/photo-1513828583688-c52646db42da?q=80&w=800&auto=format&fit=crop', 'Stainless steel pipelines in an industrial water treatment plant'],
        ['Water Softening Plants', 'Softening plants that reduce water hardness and protect pipes, taps and appliances from scale.', 'https://images.unsplash.com/photo-1585704032915-c3400ca199e7?q=80&w=800&auto=format&fit=crop', 'Chrome water tap protected from hard-water scale'],
        ['ISI RO Water Treatment Plants', 'ISI certified RO water treatment plants built to recognised quality standards.', 'https://images.unsplash.com/photo-1581093450021-4a7360e9a6b5?q=80&w=800&auto=format&fit=crop', 'Technicians testing water quality in a laboratory'],
    ];

    // Brand logos: drop image files into public/images/brands (e.g. 01.png, 02.png ...). The section hides when the folder is empty.
    $brandLogos = collect(glob(public_path('images/brands/*.{png,jpg,jpeg,webp,svg}'), GLOB_BRACE) ?: [])
        ->sort(SORT_NATURAL | SORT_FLAG_CASE)
        ->map(fn ($path) => asset('images/brands/' . basename($path)))
        ->values();

    $testimonials = [
        ['Rafath Fathima', '2 months ago', 'We have installed a RO plant in our home from Mr Gandhi .. it’s working very efficiently & their service is also very prompt'],
        ['Valluvan A', '2 months ago', 'Good'],
        ['K M Jawahar', '1 year ago', 'Very well service'],
        ['Junier Mohan', '1 year ago', 'Excellent products good experience'],
        ['Vijaya Lakshmi', '1 year ago', 'my name is shanmugam, GSC RO Aqua water treatment this company I know 15 years , Good product purchase and Ro plant domastic and commercial Good service given too.'],
    ];
@endphp

<!-- 1. Hero -->
<style>
    .hero-stack { grid-area: 1 / 1; }
</style>
<section class="relative bg-slate-950 overflow-hidden grid min-h-screen">
    @php
        $activeBanners = isset($banners) && $banners->count() > 0 ? $banners : collect([
            (object)['image' => null, 'title' => null],
        ]);
    @endphp

    <h1 class="sr-only">{{ $settings['website_name'] ?? 'Aqua Filter' }} - Pure &amp; Safe Drinking Water Solutions</h1>

    @foreach($activeBanners as $index => $banner)
        @php
            $heroImage = $banner->image ? asset('storage/' . $banner->image) : 'https://images.unsplash.com/photo-1548839140-29a749e1cf4d?q=80&w=1600&auto=format&fit=crop';
        @endphp
        <div class="hero-slide hero-stack w-full h-full relative transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none' }}">
            <img src="{{ $heroImage }}" alt="{{ $banner->title ? strip_tags($banner->title) : 'Aqua Filter banner' }}" class="absolute inset-0 w-full h-full object-cover object-center" @if($index > 0) loading="lazy" @endif>
        </div>
    @endforeach

    @if($activeBanners->count() > 1)
        <!-- Controls -->
        <button id="hero-prev" class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur border border-white/20 transition-all focus:outline-none" aria-label="Previous slide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button id="hero-next" class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur border border-white/20 transition-all focus:outline-none" aria-label="Next slide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const slides = document.querySelectorAll('.hero-slide');
                if (slides.length <= 1) return;
                
                let current = 0;
                let timer;
                
                const showSlide = (index) => {
                    slides.forEach((slide, i) => {
                        if (i === index) {
                            slide.classList.remove('opacity-0', 'z-0', 'pointer-events-none');
                            slide.classList.add('opacity-100', 'z-10');
                        } else {
                            slide.classList.remove('opacity-100', 'z-10');
                            slide.classList.add('opacity-0', 'z-0', 'pointer-events-none');
                        }
                    });
                };
                
                const nextSlide = () => {
                    current = (current + 1) % slides.length;
                    showSlide(current);
                    resetTimer();
                };
                
                const prevSlide = () => {
                    current = (current - 1 + slides.length) % slides.length;
                    showSlide(current);
                    resetTimer();
                };
                
                const resetTimer = () => {
                    clearInterval(timer);
                    timer = setInterval(nextSlide, 5000);
                };
                
                document.getElementById('hero-next').addEventListener('click', nextSlide);
                document.getElementById('hero-prev').addEventListener('click', prevSlide);
                
                resetTimer();
            });
        </script>
    @endif
</section>

<!-- 2. Welcome -->
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
        <div class="order-2 lg:order-1">
            <span class="text-xs font-bold uppercase tracking-widest text-cyan-600">Welcome</span>
            <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">Welcome To Our GSC-RO Website</h2>
            <p class="mt-5 text-lg text-slate-600 leading-relaxed">
                <strong class="text-slate-900">GSC RO Aqua</strong> specializes in water treatment systems designed for domestic and industrial applications. Explore our wide range of products designed to bring clean, purified water to your home and business.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('products') }}" class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-full bg-cyan-600 hover:bg-cyan-500 text-white font-bold shadow-lg shadow-cyan-600/30 transition-colors">
                    Explore Products
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <a href="{{ route('about') }}" class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-full bg-slate-900 hover:bg-slate-700 text-white font-bold transition-colors">
                    Learn More
                </a>
            </div>
        </div>
        <div class="order-1 lg:order-2">
            <div class="relative rounded-[2rem] overflow-hidden shadow-xl border border-slate-200 aspect-[4/3] bg-slate-100">
                <img src="https://images.unsplash.com/photo-1548839140-29a749e1cf4d?q=80&w=1200&auto=format&fit=crop" alt="Clean, purified water being poured into a glass" loading="lazy" class="absolute inset-0 w-full h-full object-cover">
            </div>
        </div>
    </div>
</section>

<!-- 3. Categories -->
<section class="py-16 lg:py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-cyan-600">Our Categories</span>
            <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Water Treatment Solutions</h2>
            <p class="mt-4 text-lg text-slate-600 hidden lg:block">Hover over a category to see more information.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($homeCategories as [$catTitle, $catText, $catImage, $catAlt])
                <div class="group relative h-80 rounded-3xl overflow-hidden border border-slate-200 shadow-sm bg-slate-200 focus-within:ring-4 focus-within:ring-cyan-200">
                    <img src="{{ $catImage }}" alt="{{ $catAlt }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-6 text-white">
                        <h3 class="text-xl font-extrabold leading-snug">{{ $catTitle }}</h3>
                        <div class="overflow-hidden transition-all duration-300 lg:max-h-0 lg:opacity-0 lg:group-hover:max-h-48 lg:group-hover:opacity-100 lg:group-focus-within:max-h-48 lg:group-focus-within:opacity-100">
                            <p class="mt-2 text-sm text-slate-200 leading-relaxed">{{ $catText }}</p>
                            <a href="{{ route('products') }}" class="mt-4 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-cyan-500 hover:bg-cyan-400 text-white text-sm font-bold transition-colors">
                                Learn More
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 4. Brands -->
@if($brandLogos->isNotEmpty())
<style>
    @keyframes brand-scroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }
    .brand-track { animation: brand-scroll 40s linear infinite; }
    .brand-marquee:hover .brand-track { animation-play-state: paused; }
    @media (prefers-reduced-motion: reduce) { .brand-track { animation: none; } }
</style>
<section class="py-14 lg:py-16 bg-white border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-center text-sm md:text-base font-extrabold uppercase tracking-widest text-slate-900">Our Machines Use Parts From World Class Brands</h2>
        <div class="brand-marquee mt-8 overflow-hidden" style="-webkit-mask-image: linear-gradient(to right, transparent, #000 8%, #000 92%, transparent); mask-image: linear-gradient(to right, transparent, #000 8%, #000 92%, transparent);">
            <div class="brand-track flex w-max items-center">
                @foreach([0, 1] as $copy)
                    @foreach($brandLogos as $i => $logo)
                        <div class="shrink-0 w-36 h-20 mx-4 flex items-center justify-center rounded-2xl border border-slate-200 bg-white p-4" @if($copy) aria-hidden="true" @endif>
                            <img src="{{ $logo }}" alt="{{ $copy ? '' : 'Brand ' . ($i + 1) }}" loading="lazy" class="max-w-full max-h-full object-contain">
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<!-- 5. Our Process -->
<section class="py-16 lg:py-24 bg-cyan-50/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-cyan-600">How We Work</span>
            <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Our Process</h2>
            <p class="mt-4 text-lg text-slate-600">From your first message to final installation, four simple steps.</p>
        </div>
        <ol class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($processSteps as $i => [$title, $text, $icon])
                <li class="reveal-fade-up relative h-full bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 hover:shadow-xl hover:border-cyan-200 hover:-translate-y-1 transition-all duration-300 group" style="transition-delay: {{ $i * 150 }}ms;">
                    <span class="absolute top-5 right-6 text-5xl font-black text-slate-100 group-hover:text-cyan-100 transition-colors select-none" aria-hidden="true">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <div class="relative w-14 h-14 bg-cyan-500 text-white rounded-2xl flex items-center justify-center mb-5 shadow-lg shadow-cyan-500/30">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path></svg>
                    </div>
                    <p class="relative text-xs font-bold text-cyan-600 uppercase tracking-widest mb-1">Step {{ $i + 1 }}</p>
                    <h3 class="relative text-lg font-extrabold text-slate-900 mb-2">{{ $title }}</h3>
                    <p class="relative text-slate-600 leading-relaxed">{{ $text }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>

<!-- 6. Products -->
@if($products->isNotEmpty())
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 lg:mb-12">
            <div class="max-w-2xl">
                <span class="text-xs font-bold uppercase tracking-widest text-cyan-600">Our Products</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Aqua Filter Products</h2>
                <p class="mt-4 text-lg text-slate-600">Water purification products for homes, offices and commercial use.</p>
            </div>
            <a href="{{ route('products') }}" class="self-start md:self-auto inline-flex items-center gap-2 px-6 py-3 rounded-full border-2 border-slate-200 text-slate-700 font-bold hover:border-cyan-500 hover:text-cyan-600 transition-colors whitespace-nowrap">
                View All Products
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach($products as $product)
                @include('frontend.partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- 7. Filtration Solutions -->
<section class="py-16 lg:py-24 bg-slate-950 text-white relative overflow-hidden">
    <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-cyan-500/20 blur-3xl pointer-events-none" aria-hidden="true"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-cyan-400">Filtration Solutions</span>
            <h2 class="mt-3 text-3xl md:text-4xl font-extrabold tracking-tight">The Right Solution for Your Water</h2>
            <p class="mt-4 text-lg text-slate-300">Different water sources need different treatment. Aqua Filter helps you choose what fits.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">
            @foreach($solutions as [$title, $text, $icon])
                <div class="h-full rounded-3xl bg-white/5 border border-white/10 p-6 lg:p-8 hover:bg-white/10 hover:border-cyan-400/40 transition-colors">
                    <div class="w-12 h-12 rounded-2xl bg-cyan-400/15 text-cyan-300 flex items-center justify-center mb-5 border border-cyan-400/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path></svg>
                    </div>
                    <h3 class="text-lg font-extrabold">{{ $title }}</h3>
                    <p class="mt-2 text-slate-300 leading-relaxed">{{ $text }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 8. Quality & Trust -->
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-5 gap-10 lg:gap-14 items-start">
        <div class="lg:col-span-2 lg:sticky lg:top-28">
            <span class="text-xs font-bold uppercase tracking-widest text-cyan-600">Quality &amp; Trust</span>
            <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">Built on Quality, Backed by Service</h2>
            <p class="mt-4 text-lg text-slate-600 leading-relaxed">Clean water matters every day. That is why Aqua Filter puts quality and honest service at the centre of everything we do.</p>
        </div>
        <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 gap-5">
            @foreach($trust as $i => [$title, $text])
                <div class="h-full rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <div class="flex items-center gap-3">
                        <span class="w-9 h-9 shrink-0 rounded-full bg-cyan-500 text-white flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </span>
                        <h3 class="text-lg font-extrabold text-slate-900">{{ $title }}</h3>
                    </div>
                    <p class="mt-3 text-slate-600 leading-relaxed">{{ $text }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 9. Testimonials -->
<style>
    @keyframes review-scroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }
    .review-track { animation: review-scroll 45s linear infinite; }
    .review-marquee:hover .review-track,
    .review-marquee:focus-within .review-track,
    .review-track.is-paused { animation-play-state: paused; }
    @media (prefers-reduced-motion: reduce) {
        .review-track { animation: none; }
        .review-marquee { overflow-x: auto; }
        .review-copy { display: none; }
    }
</style>
<section class="py-16 lg:py-24 bg-cyan-50/60 overflow-hidden" x-data="{ openCount: 0 }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-cyan-600">Testimonials</span>
            <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">What Our Customers Say</h2>
        </div>
    </div>

    <div class="review-marquee overflow-hidden py-2" style="-webkit-mask-image: linear-gradient(to right, transparent, #000 6%, #000 94%, transparent); mask-image: linear-gradient(to right, transparent, #000 6%, #000 94%, transparent);">
        <div class="review-track flex w-max items-stretch" :class="{ 'is-paused': openCount > 0 }">
            @foreach([0, 1] as $copy)
                @foreach($testimonials as [$reviewer, $when, $review])
                    @php
                        $initials = collect(preg_split('/\s+/', trim($reviewer)))->take(2)->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode('');
                    @endphp
                    <figure x-data="{ open: false, clamped: false, measure() { const t = this.$refs.text; this.clamped = t.scrollHeight > t.clientHeight + 1; }, toggle() { this.open = !this.open; this.openCount += this.open ? 1 : -1; } }" x-init="$nextTick(() => measure())" @resize.window.debounce.200ms="if (!open) measure()" class="{{ $copy ? 'review-copy ' : '' }}shrink-0 w-[280px] sm:w-[340px] mx-3 bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 flex flex-col" @if($copy) aria-hidden="true" @endif>
                        <svg class="w-8 h-8 text-cyan-200" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z"/></svg>
                        <blockquote class="mt-4 flex-1">
                            <p x-ref="text" class="text-slate-700 leading-relaxed line-clamp-4" :class="{ 'line-clamp-none': open }">{{ $review }}</p>
                            <button type="button" x-show="clamped || open" style="display: none;" @click="toggle()" @if($copy) tabindex="-1" @endif class="mt-2 text-sm font-bold text-cyan-600 hover:text-cyan-700 transition-colors" x-text="open ? 'Read less' : 'Read more'" :aria-expanded="open.toString()">Read more</button>
                        </blockquote>
                        <figcaption class="mt-6 pt-5 border-t border-slate-100 flex items-center gap-3">
                            <span class="w-11 h-11 shrink-0 rounded-full bg-gradient-to-br from-cyan-500 to-teal-600 text-white flex items-center justify-center font-extrabold" aria-hidden="true">{{ $initials }}</span>
                            <span class="min-w-0">
                                <span class="block font-extrabold text-slate-900 truncate">{{ $reviewer }}</span>
                                <span class="block text-sm text-slate-500 font-medium">{{ $when }}</span>
                            </span>
                        </figcaption>
                    </figure>
                @endforeach
            @endforeach
        </div>
    </div>
</section>

<!-- 10. Call to action -->
<section class="pb-16 lg:pb-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-[2rem] bg-gradient-to-r from-cyan-600 to-teal-700 px-6 py-12 sm:px-12 lg:py-16 text-center text-white shadow-xl shadow-cyan-600/20">
            <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight">Ready for Cleaner, Safer Water?</h2>
            <p class="mt-4 text-lg text-cyan-100 max-w-2xl mx-auto">Tell us about your water source and requirements. The Aqua Filter team will recommend the right solution for you.</p>
            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('requirement') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full bg-white text-teal-700 font-bold hover:bg-cyan-50 transition-colors shadow-lg">
                    Enquire Now
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-full border-2 border-white/40 text-white font-bold hover:bg-white/10 hover:border-white transition-colors">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
