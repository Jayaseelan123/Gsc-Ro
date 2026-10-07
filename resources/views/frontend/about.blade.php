@extends('layouts.frontend')
@section('title', 'About Us')
@section('content')
@php
    $services = [
        ['Domestic RO Systems', 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
        ['Industrial Water Plants', 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
        ['Water Softening Plants', 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
        ['Reverse Osmosis Plants', 'M12 21a7 7 0 01-7-7c0-3.866 7-11 7-11s7 7.134 7 11a7 7 0 01-7 7z'],
        ['ISI Certified RO Plants', 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
        ['Customized filtration systems for specific needs', 'M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z'],
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
        'Cost-Effective Solutions',
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
    'breadcrumbs' => [['Home', route('home')], ['About Us', null]],
])

<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-20 space-y-16 lg:space-y-24">

        <!-- About GSC-RO Aqua -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-cyan-600">About GSC-RO Aqua</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight flex items-start gap-3">
                    <span class="mt-1 w-10 h-10 shrink-0 rounded-xl bg-cyan-500 text-white flex items-center justify-center shadow-md shadow-cyan-500/30" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a7 7 0 01-7-7c0-3.866 7-11 7-11s7 7.134 7 11a7 7 0 01-7 7z"></path></svg>
                    </span>
                    <span>Your Trusted Partner in Clean Water Solutions</span>
                </h2>
                <p class="mt-5 text-lg text-slate-600 leading-relaxed">
                    At <strong class="text-slate-900">GSC-RO Aqua</strong>, we are committed to providing safe, clean and sustainable water purification solutions for every need - from domestic households to large-scale industries.
                </p>
            </div>
            <div class="relative rounded-[2rem] overflow-hidden shadow-xl border border-slate-200 aspect-[4/3] bg-slate-100">
                <img src="https://images.unsplash.com/photo-1548839140-29a749e1cf4d?q=80&w=1200&auto=format&fit=crop" alt="Clean water being poured into a glass" loading="lazy" class="absolute inset-0 w-full h-full object-cover">
            </div>
        </section>

        <!-- Who We Are -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
            <div class="relative order-last lg:order-first">
                <div class="relative rounded-[2rem] overflow-hidden shadow-xl border border-slate-200 aspect-[4/3] bg-slate-100">
                    <img src="https://images.unsplash.com/photo-1513828583688-c52646db42da?q=80&w=1200&auto=format&fit=crop" alt="Stainless steel pipelines and tanks in an industrial water treatment plant" loading="lazy" class="absolute inset-0 w-full h-full object-cover">
                </div>
                <div class="absolute -bottom-6 left-4 right-4 sm:left-8 sm:right-auto bg-white rounded-2xl border border-slate-200 shadow-xl px-6 py-4 flex items-center gap-4">
                    <p class="text-4xl font-black text-cyan-600 tracking-tight">20+</p>
                    <div>
                        <p class="text-sm font-extrabold uppercase tracking-widest text-slate-900">Years of Expertise</p>
                        <p class="text-sm text-slate-600 font-medium">in Water Treatment Solutions</p>
                    </div>
                </div>
            </div>
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-cyan-600">Who We Are</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">A Pioneering Name in Water Treatment</h2>
                <p class="mt-5 text-lg text-slate-600 leading-relaxed">
                    GSC-RO Aqua is a pioneering name in the water treatment industry, dedicated to delivering clean, safe and sustainable water solutions. With 20+ years of expertise and a passion for excellence, we’ve served countless homes, industries and institutions with precision and care.
                </p>
            </div>
        </section>

        <!-- What We Do -->
        <section>
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-cyan-600">Our Solutions</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">What We Do</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">
                @foreach($services as [$title, $icon])
                    <div class="h-full bg-white rounded-3xl border border-slate-200 p-6 lg:p-8 shadow-sm hover:shadow-lg hover:border-cyan-200 hover:-translate-y-1 transition-all duration-300 flex items-center gap-5">
                        <div class="w-12 h-12 shrink-0 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-md shadow-cyan-500/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path></svg>
                        </div>
                        <h3 class="text-lg font-extrabold text-slate-900">{{ $title }}</h3>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Why Choose -->
        <section class="rounded-[2rem] bg-slate-50 border border-slate-200 p-8 md:p-12">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold uppercase tracking-widest text-cyan-600">Why Choose Us</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Why Choose GSC-RO Aqua?</h2>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-stretch">
                <div class="lg:col-span-2 relative rounded-3xl overflow-hidden border border-slate-200 shadow-sm bg-slate-100 min-h-[260px] lg:min-h-0">
                    <img src="https://images.unsplash.com/photo-1581093450021-4a7360e9a6b5?q=80&w=1000&auto=format&fit=crop" alt="Technicians testing water samples in a laboratory" loading="lazy" class="absolute inset-0 w-full h-full object-cover">
                </div>
                <ul class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($reasons as $reason)
                        <li class="h-full flex items-start gap-3 bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                            <span class="mt-0.5 w-6 h-6 shrink-0 rounded-full bg-cyan-500 text-white flex items-center justify-center">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                            <span class="text-slate-700 font-semibold">{{ $reason }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <!-- Meet Our Founder -->
        <section class="bg-slate-900 rounded-[2rem] overflow-hidden flex flex-col lg:flex-row border border-slate-800">
            <div class="lg:w-2/5 relative min-h-[320px] bg-slate-800 flex items-center justify-center">
                @if($founderImage)
                    <img src="{{ $founderImage }}" alt="Mr. Gandhi, Founder of GSC-RO Aqua" loading="lazy" class="absolute inset-0 w-full h-full object-cover">
                @else
                    <div class="flex flex-col items-center text-slate-400" role="img" aria-label="Mr. Gandhi, Founder of GSC-RO Aqua">
                        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-cyan-500 to-teal-600 text-white flex items-center justify-center text-5xl font-black shadow-xl shadow-cyan-500/20">G</div>
                        <span class="mt-4 text-xs font-bold uppercase tracking-widest">Founder</span>
                    </div>
                @endif
            </div>
            <div class="flex-1 p-8 md:p-12 flex flex-col justify-center">
                <span class="text-xs font-bold uppercase tracking-widest text-cyan-400">Meet Our Founder</span>
                <h2 class="mt-3 text-3xl font-extrabold text-white">Mr. Gandhi</h2>
                <p class="mt-1 text-cyan-400 font-medium">Founder, GSC-RO Aqua</p>
                <div class="mt-6 space-y-4 text-lg text-slate-300 leading-relaxed">
                    <p>With over 20 years of hands-on experience in the water treatment and environmental solutions industry, Mr. Gandhi is the driving force behind GSC-RO Aqua. His vision for clean, sustainable and efficient water solutions led to the founding of the company — built on the core values of innovation, reliability and customer-centric service.</p>
                    <p>Throughout his career, he has been instrumental in designing and executing advanced water treatment systems across industries, consistently solving real-world challenges related to water quality, softening, filtration and reuse. His deep technical knowledge, combined with a sharp business acumen, ensures that GSC-RO Aqua delivers not just products - but long-term value and trust.</p>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
