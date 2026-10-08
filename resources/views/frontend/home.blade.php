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
            ->map(fn($path) => asset('images/brands/' . basename($path)))
            ->values();

        if ($brandLogos->isEmpty()) {
            $brandLogos = collect([
                'https://via.placeholder.com/150x80/e2e8f0/0f172a?text=Brand+1',
                'https://via.placeholder.com/150x80/e2e8f0/0f172a?text=Brand+2',
                'https://via.placeholder.com/150x80/e2e8f0/0f172a?text=Brand+3',
                'https://via.placeholder.com/150x80/e2e8f0/0f172a?text=Brand+4',
                'https://via.placeholder.com/150x80/e2e8f0/0f172a?text=Brand+5',
                'https://via.placeholder.com/150x80/e2e8f0/0f172a?text=Brand+6',
                'https://via.placeholder.com/150x80/e2e8f0/0f172a?text=Brand+7',
                'https://via.placeholder.com/150x80/e2e8f0/0f172a?text=Brand+8',
            ]);
        }

        $testimonials = [
            ['Rafath Fathima', '2 months ago', 'We have installed a RO plant in our home from Mr Gandhi .. it’s working very efficiently & their service is also very prompt'],
            ['Vijaya Lakshmi', '1 year ago', 'my name is shanmugam, GSC RO Aqua water treatment this company I know 15 years , Good product purchase and Ro plant domastic and commercial Good service given too.'],
        ];
    @endphp

    <!-- 1. Hero -->
    <style>
        .hero-stack {
            grid-area: 1 / 1;
        }
    </style>
    <section class="relative bg-slate-950 overflow-hidden grid min-h-screen">
        @php
            // Active banners from Admin > Banners (in their display order); the default images are used only when there are none.
            $heroBanners = $banners->filter(fn($banner) => filled($banner->image))
                ->map(fn($banner) => str_starts_with($banner->image, 'http') ? $banner->image : asset('storage/' . $banner->image))
                ->values()
                ->all();

            if (empty($heroBanners)) {
                $heroBanners = [
                    asset('images/banners/banner1.jpg'),
                    asset('images/banners/banner2.jpg'),
                    asset('images/banners/banner3.jpg'),
                ];
            }
        @endphp

        <h1 class="sr-only">{{ $settings['website_name'] ?? 'Aqua Filter' }} - Pure &amp; Safe Drinking Water Solutions</h1>

        @foreach($heroBanners as $index => $heroImage)
            <div
                class="hero-slide hero-stack w-full h-full relative transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none' }}">
                <img src="{{ $heroImage }}" alt="GSC-RO Banner {{ $index + 1 }}"
                    class="absolute inset-0 w-full h-full object-cover object-center" @if($index > 0) loading="lazy" @endif>
            </div>
        @endforeach

        @if(count($heroBanners) > 1)
            <!-- Controls -->
            <button id="hero-prev"
                class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur border border-white/20 transition-all focus:outline-none"
                aria-label="Previous slide">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button id="hero-next"
                class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur border border-white/20 transition-all focus:outline-none"
                aria-label="Next slide">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
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
    <section class="py-16 lg:py-24 bg-page">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
            <div class="order-2 lg:order-1">
                <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Welcome</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">Welcome To
                    Our GSC-RO </h2>
                <p class="mt-5 text-lg text-slate-600 leading-relaxed">
                    <strong class="text-slate-900">GSC RO Aqua</strong> specializes in water treatment systems designed for
                    domestic and industrial applications. Explore our wide range of products designed to bring clean,
                    purified water to your home and business.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('requirement') }}"
                        class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-full bg-brand-600 hover:bg-brand-700 text-white font-bold shadow-lg shadow-brand-600/30 transition-colors">
                        Our Requirements
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-2 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>

                    <!-- <a href="{{ route('about') }}"
                                class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-full bg-blue-900 hover:bg-blue-950 text-white font-bold shadow-lg shadow-blue-900/30 transition-colors">
                                Learn More
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-2 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a> -->

                </div>
            </div>
            <div class="order-1 lg:order-2">
                <div
                    class="relative rounded-[2rem] overflow-hidden shadow-xl border border-slate-200 aspect-[4/3] bg-slate-100">
                    <iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/B50HH4Qb9p4?rel=0"
                        title="Welcome to GSC-RO" frameborder="0" loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </section>
    @if($brandLogos->isNotEmpty())
        <style>
            @keyframes brand-scroll {
                from {
                    transform: translateX(0);
                }

                to {
                    transform: translateX(-50%);
                }
            }

            .brand-track {
                animation: brand-scroll 40s linear infinite;
            }

            .brand-marquee:hover .brand-track {
                animation-play-state: paused;
            }

            @media (prefers-reduced-motion: reduce) {
                .brand-track {
                    animation: none;
                }
            }
        </style>
        <section class="py-10 lg:py-14 bg-page border-y border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-4xl mx-auto">
                    <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Trusted Brands</span>
                    <h2 class="mt-2 text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">Our
                        Machines Use Parts From World Class Brands</h2>
                </div>
                <div class="brand-marquee mt-6 lg:mt-8 overflow-hidden"
                    style="-webkit-mask-image: linear-gradient(to right, transparent, #000 8%, #000 92%, transparent); mask-image: linear-gradient(to right, transparent, #000 8%, #000 92%, transparent);">
                    <div class="brand-track flex w-max items-center">
                        @foreach([0, 1] as $copy)
                            @foreach($brandLogos as $i => $logo)
                                <div class="shrink-0 w-24 h-10 md:w-32 md:h-12 mx-6 md:mx-10 flex items-center justify-center"
                                    @if($copy) aria-hidden="true" @endif>
                                    <img src="{{ $logo }}" alt="{{ $copy ? '' : 'Brand ' . ($i + 1) }}" loading="lazy"
                                        class="max-w-full max-h-full w-auto h-auto object-contain">
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- 3. Categories -->
    <section class="py-16 lg:py-24 bg-page">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-14">
                <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Our Categories</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Water Treatment Solutions
                </h2>
                <p class="mt-4 text-lg text-slate-600 hidden lg:block">Hover over a category to see more information.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($homeCategories as [$catTitle, $catText, $catImage, $catAlt])
                    <div tabindex="0"
                        class="group relative h-80 rounded-3xl overflow-hidden border border-slate-200 shadow-sm bg-slate-200 outline-none focus-within:ring-4 focus-within:ring-brand-200">
                        <img src="{{ $catImage }}" alt="{{ $catAlt }}" loading="lazy"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-950/90 via-brand-950/40 to-transparent"></div>
                        <div class="absolute inset-x-0 bottom-0 p-6 text-white">
                            <h3 class="text-xl font-extrabold leading-snug">{{ $catTitle }}</h3>
                            <div
                                class="overflow-hidden transition-all duration-300 lg:max-h-0 lg:opacity-0 lg:group-hover:max-h-48 lg:group-hover:opacity-100 lg:group-focus-within:max-h-48 lg:group-focus-within:opacity-100">
                                <p class="mt-2 text-sm text-slate-200 leading-relaxed">{{ $catText }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>



    <!-- 5. Our Process -->
    <section class="py-16 lg:py-24 bg-page">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-14">
                <span class="text-xs font-bold uppercase tracking-widest text-brand-600">How We Work</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Our Process</h2>
                <p class="mt-4 text-lg text-slate-600">From your first message to final installation, four simple steps.</p>
            </div>
            <ol class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($processSteps as $i => [$title, $text, $icon])
                    <li class="reveal-fade-up relative h-full bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 hover:shadow-xl hover:border-brand-200 hover:-translate-y-1 transition-all duration-300 group"
                        style="transition-delay: {{ $i * 150 }}ms;">
                        <span
                            class="absolute top-5 right-6 text-5xl font-black text-slate-100 group-hover:text-brand-100 transition-colors select-none"
                            aria-hidden="true">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <div
                            class="relative w-14 h-14 bg-brand-500 text-white rounded-2xl flex items-center justify-center mb-5 shadow-lg shadow-brand-500/30">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
                            </svg>
                        </div>
                        <p class="relative text-xs font-bold text-brand-600 uppercase tracking-widest mb-1">Step {{ $i + 1 }}
                        </p>
                        <h3 class="relative text-lg font-extrabold text-slate-900 mb-2">{{ $title }}</h3>
                        <p class="relative text-slate-600 leading-relaxed">{{ $text }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <!-- 6. Products -->
    <!-- @if($products->isNotEmpty())
                                                                    <section class="py-16 lg:py-24 bg-page">
                                                                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                                                            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 lg:mb-12">
                                                                                <div class="max-w-2xl">
                                                                                    <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Our Products</span>
                                                                                    <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Aqua Filter Products
                                                                                    </h2>
                                                                                    <p class="mt-4 text-lg text-slate-600">Water purification products for homes, offices and commercial
                                                                                        use.</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                                                                                @foreach($products as $product)
                                                                                    @include('frontend.partials.product-card', ['product' => $product])
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </section>
                                                                @endif -->



    <!-- 8. Quality & Trust -->

    <!-- 9. Testimonials -->
    <style>
        @keyframes review-scroll {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        .review-track {
            animation: review-scroll 45s linear infinite;
        }

        .review-marquee:hover .review-track,
        .review-marquee:focus-within .review-track,
        .review-track.is-paused {
            animation-play-state: paused;
        }

        @media (prefers-reduced-motion: reduce) {
            .review-track {
                animation: none;
            }

            .review-marquee {
                overflow-x: auto;
            }

            .review-copy {
                display: none;
            }
        }
    </style>
    <section class="py-16 lg:py-24 bg-page overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-14">
                <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Testimonials</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">What Our Customers Say
                </h2>
            </div>
        </div>

        <div class="review-marquee overflow-hidden py-2"
            style="-webkit-mask-image: linear-gradient(to right, transparent, #000 6%, #000 94%, transparent); mask-image: linear-gradient(to right, transparent, #000 6%, #000 94%, transparent);">
            @php
                // Repeat the reviews so each half of the loop is wider than the widest screen (each card is 364px with its margin);
                // otherwise a gap shows before the loop restarts. The duration grows with the repeats so the speed stays the same.
                $reviewRepeats = max(1, (int) ceil(2560 / (max(1, count($testimonials)) * 364)));
            @endphp
            <div class="review-track flex w-max items-stretch" style="animation-duration: {{ $reviewRepeats * 45 }}s;">
                @foreach(range(0, $reviewRepeats * 2 - 1) as $copy)
                    @foreach($testimonials as [$reviewer, $when, $review])
                        @php
                            $initials = collect(preg_split('/\s+/', trim($reviewer)))->take(2)->map(fn($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode('');
                        @endphp
                        <figure
                            class="{{ $copy ? 'review-copy ' : '' }}shrink-0 w-[280px] sm:w-[340px] mx-3 bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 flex flex-col"
                            @if($copy) aria-hidden="true" @endif>
                            <svg class="w-8 h-8 text-brand-200" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z" />
                            </svg>
                            <blockquote class="mt-4 flex-1">
                                <p class="text-slate-700 leading-relaxed">{{ $review }}</p>
                            </blockquote>
                            <figcaption class="mt-6 pt-5 border-t border-slate-100 flex items-center gap-3">
                                <span
                                    class="w-11 h-11 shrink-0 rounded-full bg-gradient-to-br from-brand-500 to-brand-600 text-white flex items-center justify-center font-extrabold"
                                    aria-hidden="true">{{ $initials }}</span>
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
    <section class="pb-16 lg:pb-24 bg-page">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="rounded-[2rem] bg-gradient-to-r from-brand-600 to-brand-700 px-6 py-12 sm:px-12 lg:py-16 text-center text-white shadow-xl shadow-brand-600/20">
                <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight">Ready for Cleaner, Safer Water?</h2>
                <p class="mt-4 text-lg text-brand-100 max-w-2xl mx-auto">Tell us about your water source and requirements.
                    The Aqua Filter team will recommend the right solution for you.</p>
                <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('requirement') }}"
                        class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full bg-white text-brand-700 font-bold hover:bg-brand-50 transition-colors shadow-lg">
                        Enquire Now
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center px-8 py-4 rounded-full border-2 border-white/40 text-white font-bold hover:bg-white/10 hover:border-white transition-colors">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection