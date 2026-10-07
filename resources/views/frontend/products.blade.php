@extends('layouts.frontend')
@section('title', 'All Products')
@section('content')
@include('frontend.partials.page-hero', [
    'eyebrow' => 'Our Catalog',
    'title' => 'Premium Collections',
    'subtitle' => 'Browse our comprehensive selection of premium categories engineered for modern demands.',
    'breadcrumbs' => [['Home', route('home')], ['Products', null]],
])

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-16">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($categories as $category)
        <a href="{{ route('products.category', $category->slug) }}" class="group block bg-white rounded-[2.5rem] shadow-sm border border-slate-200 hover:shadow-2xl hover:border-teal-300 transition-all duration-300 overflow-hidden relative h-[380px] flex flex-col hover:-translate-y-2">
            <div class="absolute inset-0 bg-slate-100 z-0">
                <img src="{{ $category->image ? asset('storage/'.$category->image) : 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=800&auto=format&fit=crop' }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-in-out mix-blend-multiply opacity-90">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/70 to-transparent opacity-90 group-hover:opacity-95 transition-opacity"></div>
            </div>
            
            <div class="relative z-10 mt-auto p-8 flex flex-col h-full justify-end text-left">
                <h3 class="text-3xl font-extrabold text-white mb-4 tracking-tight group-hover:text-teal-200 transition-colors">{{ $category->name }}</h3>
                <p class="text-slate-200 line-clamp-3 mb-8 font-light text-lg leading-relaxed">{{ $category->description }}</p>
                <div class="inline-flex items-center gap-3 text-white font-bold group-hover:text-teal-300 transition-colors mt-auto uppercase tracking-wider text-sm">
                    Explore Category 
                    <span class="bg-white/20 p-2.5 rounded-full group-hover:bg-teal-600 transition-colors backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection