@extends('layouts.frontend')
@section('title', 'Company Profile')
@section('content')

<!-- Header Banner -->
<div class="relative bg-brand-950 py-14 sm:py-20 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover opacity-20 mix-blend-luminosity">
        <div class="absolute inset-0 bg-gradient-to-r from-brand-900/90 to-brand-950/90"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-500/20 text-brand-300 font-bold text-sm mb-6 border border-brand-400/30 uppercase tracking-wider backdrop-blur-sm">
            <span class="w-2 h-2 rounded-full bg-brand-400 animate-pulse"></span> Our Profile
        </div>
        <h1 class="text-4xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-6">Company Profile</h1>
        <p class="text-xl text-brand-100/80 max-w-2xl mx-auto font-light leading-relaxed">Discover our vision, mission, and the journey that has made us an industry leader.</p>
    </div>
</div>

<section class="py-16 bg-page relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-slate-50 rounded-[2.5rem] p-8 md:p-12 shadow-sm border border-slate-100 mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-6">Who We Are</h2>
                    <p class="text-lg text-slate-600 mb-6 leading-relaxed">
                        {{ $settings['website_name'] ?? 'CSRGO' }} is a leading provider of innovative solutions, committed to excellence and customer satisfaction. With years of experience in the industry, our dedicated team works tirelessly to deliver high-quality products and services that meet the evolving needs of our clients globally.
                    </p>
                    <p class="text-lg text-slate-600 leading-relaxed">
                        Our journey began with a simple yet powerful idea: to transform the industry through innovation and reliability. Today, we stand as a trusted partner for businesses and individuals alike, driving success and building lasting relationships.
                    </p>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop" alt="Our Team" class="rounded-3xl shadow-2xl">
                    <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-3xl shadow-xl border border-slate-100 hidden md:block">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-brand-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <p class="text-2xl font-extrabold text-slate-900">10+</p>
                                <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Years Experience</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="w-14 h-14 rounded-2xl bg-brand-50 flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <h3 class="text-2xl font-extrabold text-slate-900 mb-4">Our Vision</h3>
                <p class="text-slate-600 leading-relaxed">
                    To be the global leader in our sector, recognized for our innovative approach, unyielding commitment to quality, and the positive impact we create for our clients, employees, and communities.
                </p>
            </div>
            
            <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="w-14 h-14 rounded-2xl bg-brand-50 flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                <h3 class="text-2xl font-extrabold text-slate-900 mb-4">Our Mission</h3>
                <p class="text-slate-600 leading-relaxed">
                    To consistently deliver superior value through continuous improvement, sustainable practices, and an unwavering dedication to understanding and exceeding our customers' expectations.
                </p>
            </div>
        </div>

    </div>
</section>

@endsection
