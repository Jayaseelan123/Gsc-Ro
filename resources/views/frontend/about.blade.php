@extends('layouts.frontend')
@section('title', 'About Us')
@section('content')
    @php
        // Card images live in public/images (services/ holds the topic photos).
        $services = [
            ['Domestic RO Systems', 'images/aq1.png', 'Advanced domestic reverse osmosis systems ensuring 100% safe and pure drinking water for your entire home.'],
            ['Industrial Water Plants', 'images/services/industrial-water-plant.jpg', 'High-capacity industrial water purification plants designed for continuous efficiency and large-scale manufacturing operations.'],
            ['Water Softening Plants', 'images/services/water-softening-plant.jpg', 'Highly effective hard water treatment solutions that protect expensive equipment and improve overall water quality.'],
            ['Reverse Osmosis Plants', 'images/services/reverse-osmosis-plant.jpg', 'State-of-the-art RO plants delivering unparalleled purity and performance for commercial and institutional needs.'],
            ['ISI Certified RO Plants', 'images/services/isi-certified-ro-plant.jpg', 'Government-approved, strictly certified purification plants meeting the highest national safety and quality standards.'],
            ['Customized Filtration Systems', 'images/services/customized-filtration-system.jpg', 'Tailor-made filtration setups carefully designed and engineered based on your unique water testing reports and requirements.'],
        ];

        $reasons = [
            'ISO-certified systems',
            '20+ Years of Expertise in Water Treatment Solutions',
            'Transparent pricing & consultation',
            'Robust after-sales service',
            'Tailored solutions based on water testing',
            'Trusted by 100+ brands across India',
            'High-Quality Components',
            'Advanced Filtration Technologies',

        ];

        // Founder photo: uses the "founder_image" website setting, or public/images/founder.jpg if present.
        $founderImage = !empty($settings['founder_image'])
            ? asset('storage/' . $settings['founder_image'])
            : (file_exists(public_path('images/founder.jpg')) ? asset('images/founder.jpg') : null);
    @endphp

    @include('frontend.partials.page-hero', [
        'eyebrow' => 'About Us',
        'title' => 'About GSC-RO Aqua',
        'subtitle' => 'Your Trusted Partner in Clean Water Solutions',
    ])

    <div class="bg-page">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-20 space-y-16 lg:space-y-24">

            <!-- About GSC-RO Aqua -->
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-brand-600">About GSC-RO Aqua</span>
                    <h2
                        class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight flex items-start gap-3">
                        <span
                            class="mt-1 w-10 h-10 shrink-0 rounded-xl bg-brand-500 text-white flex items-center justify-center shadow-md shadow-brand-500/30"
                            aria-hidden="true">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 21a7 7 0 01-7-7c0-3.866 7-11 7-11s7 7.134 7 11a7 7 0 01-7 7z"></path>
                            </svg>
                        </span>
                        <span>Your Trusted Partner in Clean Water Solutions</span>
                    </h2>
                    <p class="mt-5 text-lg text-slate-600 leading-relaxed">
                        At <strong class="text-slate-900">GSC-RO Aqua</strong>, we are committed to providing safe, clean
                        and sustainable water purification solutions for every need - from domestic households to
                        large-scale industries.
                    </p>
                </div>
                <div
                    class="relative rounded-[2rem] overflow-hidden shadow-xl border border-slate-200 aspect-[4/3] bg-white">
                    <img src="{{ asset('images/who-we-are.jpg') }}"
                        alt="GSC-RO 1000 LPH reverse osmosis plant with softener tanks" loading="lazy"
                        class="absolute inset-0 w-full h-full object-cover">
                </div>
            </section>

            <section class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
                <div class="relative order-last lg:order-first">
                    <div
                        class="relative rounded-[2rem] overflow-hidden shadow-xl border border-slate-200 aspect-[4/3] bg-white">
                        <img src="{{ asset('images/who-we-are-plant.jpg') }}"
                            alt="Industrial reverse osmosis plant with membrane housings and high-pressure pumps"
                            loading="lazy" class="absolute inset-0 w-full h-full object-cover">
                    </div>
                    <div
                        class="absolute -bottom-6 left-4 right-4 sm:left-8 sm:right-auto bg-white rounded-2xl border border-slate-200 shadow-xl px-6 py-4 flex items-center gap-4">
                        <p class="text-4xl font-black text-brand-600 tracking-tight">20+</p>
                        <div>
                            <p class="text-sm font-extrabold uppercase tracking-widest text-slate-900">Years of Expertise
                            </p>
                            <p class="text-sm text-slate-600 font-medium">in Water Treatment Solutions</p>
                        </div>
                    </div>
                </div>
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Who We Are</span>
                    <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">A
                        Pioneering Name in Water Treatment</h2>
                    <p class="mt-5 text-lg text-slate-600 leading-relaxed">
                        GSC-RO Aqua is a pioneering name in the water treatment industry, dedicated to delivering clean,
                        safe and sustainable water solutions. With 20+ years of expertise and a passion for excellence,
                        we’ve served countless homes, industries and institutions with precision and care.
                    </p>
                </div>
            </section>

            <!-- What We Do -->
            <section>
                <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-12">
                    <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Our Solutions</span>
                    <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">What We Do</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 pt-2">
                    @foreach($services as [$title, $image, $description])
                        <div
                            class="group bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-2xl hover:border-brand-300 transition-all duration-300 flex flex-col h-full cursor-pointer">
                            <div class="relative w-full aspect-video overflow-hidden bg-slate-100 shrink-0">
                                <div
                                    class="absolute inset-0 bg-brand-900/10 group-hover:bg-transparent transition-colors duration-500 z-10">
                                </div>
                                <img src="{{ asset($image) }}" alt="{{ $title }}" loading="lazy"
                                    class="relative z-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                            </div>
                            <div class="p-6 md:p-8 flex flex-col flex-1 bg-white relative z-20">
                                <h3
                                    class="text-xl font-extrabold text-slate-900 mb-3 group-hover:text-brand-700 transition-colors">
                                    {{ $title }}
                                </h3>
                                <p class="text-slate-600 text-sm leading-relaxed flex-1">{{ $description }}</p>
                                <!-- <div
                                                    class="mt-6 flex items-center text-brand-600 font-bold text-sm uppercase tracking-wider group-hover:text-brand-800 transition-colors">
                                                    Explore Service
                                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-2 transition-transform duration-300"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                    </svg>
                                                </div> -->
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Why Choose -->
            <section class="rounded-[2rem] bg-slate-50 border border-slate-200 p-8 md:p-12">
                <div class="text-center max-w-2xl mx-auto mb-10">
                    <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Why Choose Us</span>
                    <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Why Choose GSC-RO
                        Aqua?</h2>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-stretch">
                    {{-- The photo is tall, so it sits in a side column; the list beside it stretches to the same height.
                    --}}
                    <div
                        class="lg:col-span-2 relative rounded-3xl overflow-hidden border border-slate-200 shadow-sm bg-slate-100 aspect-[4/5] sm:aspect-[3/4]">
                        <img src="{{ asset('images/why-choose-plant.jpg') }}"
                            alt="GSC-RO 250 LPH reverse osmosis plant with softener tank" loading="lazy"
                            class="absolute inset-0 w-full h-full object-cover">
                    </div>
                    <ul class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:auto-rows-fr gap-4">
                        @foreach($reasons as $reason)
                            <li
                                class="h-full flex items-center gap-3 bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                                <span
                                    class="w-6 h-6 shrink-0 rounded-full bg-brand-500 text-white flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span class="text-slate-700 font-semibold">{{ $reason }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>

            <!-- Meet Our Founder -->
            <section class="bg-brand-950 rounded-[2rem] overflow-hidden flex flex-col lg:flex-row border border-brand-900">
                <div class="lg:w-2/5 relative min-h-[320px] bg-brand-900 flex items-center justify-center">
                    @if($founderImage)
                        <img src="{{ $founderImage }}" alt="Mr. Gandhi, Founder of GSC-RO Aqua" loading="lazy"
                            class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <div class="flex flex-col items-center text-brand-100/80" role="img"
                            aria-label="Mr. Gandhi, Founder of GSC-RO Aqua">
                            <div
                                class="w-32 h-32 rounded-full bg-gradient-to-br from-brand-500 to-brand-600 text-white flex items-center justify-center text-5xl font-black shadow-xl shadow-brand-500/20">
                                G</div>
                            <span class="mt-4 text-xs font-bold uppercase tracking-widest">Founder</span>
                        </div>
                    @endif
                </div>
                <div class="flex-1 p-8 md:p-12 flex flex-col justify-center">
                    <span class="text-xs font-bold uppercase tracking-widest text-brand-400">Meet Our Founder</span>
                    <h2 class="mt-3 text-3xl font-extrabold text-white">Mr. Gandhi</h2>
                    <p class="mt-1 text-brand-400 font-medium">Founder, GSC-RO Aqua</p>
                    <div class="mt-6 space-y-4 text-lg text-brand-50/90 leading-relaxed">
                        <p>With over 20 years of hands-on experience in the water treatment and environmental solutions
                            industry, Mr. Gandhi is the driving force behind GSCRO. His vision for clean, sustainable and
                            efficient water solutions led to the founding of the company — built on the core values of
                            innovation, reliability and customer-centric service.</p>
                        <p>Throughout his career, he has been instrumental in designing and executing advanced water
                            treatment systems across industries, consistently solving real-world challenges related to water
                            quality, softening, filtration and reuse. His deep technical knowledge, combined with a sharp
                            business acumen, ensures that GSCRO delivers not just products - but long-term value and trust.
                        </p>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection