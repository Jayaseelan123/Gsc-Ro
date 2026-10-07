@extends('layouts.frontend')
@section('title', 'Gallery')
@section('content')
<!-- Header -->
<div class="bg-slate-900 pt-16 pb-14 relative overflow-hidden">
    <div class="absolute inset-0 opacity-30"><img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069&auto=format&fit=crop" alt="Corporate Architecture" class="w-full h-full object-cover"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/90 to-slate-900/60"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 flex flex-col items-center">
        <span class="px-4 py-1.5 rounded-full bg-teal-600/20 text-teal-400 font-bold text-sm tracking-widest uppercase mb-6 border border-teal-500/30 backdrop-blur">Portfolio</span>
        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 tracking-tight">Media Gallery</h1>
        <p class="text-xl text-slate-300 font-light max-w-2xl mx-auto">Explore our portfolio, facilities, and the premium quality standards we maintain daily.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-16">
    @if($images->count() > 0)
    <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-8">
        @foreach($images as $image)
        @php
            $imgSrc = $image->thumbnailUrl();
            $embedUrl = $image->isVideo() ? $image->youtubeEmbedUrl(true) : null;
            $videoFile = $image->isVideo() ? $image->videoFileUrl() : null;
        @endphp
        <figure class="break-inside-avoid mb-8 bg-white rounded-[2rem] overflow-hidden shadow-sm border border-slate-200">
            @if($embedUrl)
                {{-- YouTube: show the thumbnail first and load the player only when it is clicked. --}}
                <div x-data="{ playing: false }" class="relative aspect-video bg-slate-900">
                    <template x-if="!playing">
                        <button type="button" @click="playing = true" class="group absolute inset-0 w-full h-full" aria-label="Play video{{ $image->title ? ': ' . $image->title : '' }}">
                            @if($imgSrc)
                                <img src="{{ $imgSrc }}" alt="{{ $image->title ?: 'Gallery video' }}" loading="lazy" class="w-full h-full object-cover">
                            @endif
                            <span class="absolute inset-0 bg-slate-900/20 group-hover:bg-slate-900/30 transition-colors"></span>
                            <span class="absolute inset-0 flex items-center justify-center">
                                <span class="w-16 h-16 rounded-full bg-white/95 text-slate-900 shadow-xl flex items-center justify-center transition-transform group-hover:scale-110">
                                    <svg class="w-7 h-7 ml-1" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                                </span>
                            </span>
                        </button>
                    </template>
                    <template x-if="playing">
                        <iframe src="{{ $embedUrl }}" title="{{ $image->title ?: 'Gallery video' }}" class="absolute inset-0 w-full h-full" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </template>
                </div>
            @elseif($videoFile)
                <video src="{{ $videoFile }}{{ $imgSrc ? '' : '#t=0.1' }}" @if($imgSrc) poster="{{ $imgSrc }}" @endif controls playsinline preload="metadata" class="block w-full h-auto bg-slate-900" aria-label="{{ $image->title ?: 'Gallery video' }}"></video>
            @else
                <img src="{{ $imgSrc }}" alt="{{ $image->title ?: 'Gallery image' }}" loading="lazy" class="block w-full h-auto">
            @endif
            @if($image->title || $image->description)
                <figcaption class="px-6 py-5">
                    @if($image->title)
                        <h3 class="text-slate-900 font-extrabold text-lg break-words">{{ $image->title }}</h3>
                    @endif
                    @if($image->description)
                        <p class="text-slate-500 text-sm leading-relaxed mt-1">{{ $image->description }}</p>
                    @endif
                </figcaption>
            @endif
        </figure>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 bg-white rounded-[3rem] border border-dashed border-slate-300 shadow-sm">
        <svg class="w-20 h-20 text-slate-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <h2 class="text-3xl font-bold text-slate-700 mb-4 tracking-tight">Gallery Empty</h2>
        <p class="text-slate-500 text-lg font-light">We will be uploading media assets shortly.</p>
    </div>
    @endif
</div>
@endsection