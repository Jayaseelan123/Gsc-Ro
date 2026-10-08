@extends('layouts.frontend')
@section('title', 'Gallery')
@section('content')
@include('frontend.partials.page-hero', [
    'eyebrow' => 'Portfolio',
    'title' => 'Media Gallery',
    'subtitle' => 'Explore our portfolio, facilities, and the premium quality standards we maintain daily.',
])

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-16">
    @if($images->count() > 0)
        @php
            $photos = $images->filter(function($img) { return !$img->isVideo(); });
            $videos = $images->filter(function($img) { return $img->isVideo(); });
        @endphp

        @if($photos->count() > 0)
            <div class="mb-16">
 <h2 class="text-center text-3xl md:text-4xl font-bold text-brand-800 tracking-tight mb-8 lg:mb-10">
                           Photos</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($photos as $image)
                        @php
                            $imgSrc = $image->thumbnailUrl();
                        @endphp
                        <figure class="bg-white rounded-[2rem] overflow-hidden shadow-sm border border-slate-200 h-full flex flex-col">
                            <img src="{{ $imgSrc }}" alt="{{ $image->title ?: 'Gallery image' }}" loading="lazy" class="w-full h-full object-cover">
                            {{-- Text removed as per user request --}}
                        </figure>
                    @endforeach
                </div>
            </div>
        @endif

        @if($videos->count() > 0)
            <div>

                 <h2 class="text-center text-3xl md:text-4xl font-bold text-brand-800 tracking-tight mb-8 lg:mb-10">
                            Video</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($videos as $image)
                        @php
                            $imgSrc = $image->thumbnailUrl();
                            $embedUrl = $image->youtubeEmbedUrl(true);
                            $videoFile = $image->videoFileUrl();
                        @endphp
                        <figure class="bg-white rounded-[2rem] overflow-hidden shadow-sm border border-slate-200">
                            @if($embedUrl)
                                {{-- YouTube: show the thumbnail first and load the player only when it is clicked. --}}
                                <div x-data="{ playing: false }" class="relative aspect-video w-full bg-slate-900">
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
                                <video src="{{ $videoFile }}{{ $imgSrc ? '' : '#t=0.1' }}" @if($imgSrc) poster="{{ $imgSrc }}" @endif controls playsinline preload="metadata" class="block w-full aspect-video object-cover bg-slate-900" aria-label="{{ $image->title ?: 'Gallery video' }}"></video>
                            @endif
                            {{-- Text removed as per user request --}}
                        </figure>
                    @endforeach
                </div>
            </div>
        @endif
    @else
    <div class="text-center py-16 bg-white rounded-[3rem] border border-dashed border-slate-300 shadow-sm">
        <svg class="w-20 h-20 text-slate-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <h2 class="text-3xl font-bold text-slate-700 mb-4 tracking-tight">Gallery Empty</h2>
        <p class="text-slate-500 text-lg font-light">We will be uploading media assets shortly.</p>
    </div>
    @endif
</div>
@endsection